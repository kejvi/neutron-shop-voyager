<?php

namespace App\Http\Controllers;

use App\Article;
use App\Hshpikat;
use App\KthimDekoderi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Voyager;
use  Auth;
use DB;
use App\Office;
use TCG\Voyager\Events\BreadDataAdded;
use Validator;
use Illuminate\Validation\Rule;
use TCG\Voyager\Database\Schema\SchemaManager;

use DataType;



class ReturnsController extends VoyagerBaseController
{

    public function index(Request $request)
    {
        $user = Auth::user();
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', null);
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + 1;
            $orderColumn = [[$index, 'desc']];
            if (!$sortOrder && isset($dataType->order_direction)) {
                $sortOrder = $dataType->order_direction;
                $orderColumn = [[$index, $dataType->order_direction]];
            } else {
                $orderColumn = [[$index, 'desc']];
            }
        }

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model::select('*');

            if(!Voyager::can('approve_returns')){
                $query->where('user_id', '=' , $user->id);
            }


            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = isset($dataType->default_search_key) ? $dataType->default_search_key : null;

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchable',
            'isServerSide',
            'defaultSearchKey'
        ));
    }

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

//        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
//            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        if($request->input('message') == 'true'){
            if($dataTypeContent->status == 'aprovuar'){
                $request->session()->flash('message', 'Kerkesa juaj eshte aprovuar. Ju lutem printoni faturen');
                $request->session()->flash('alert-type', 'success');
            }else{
                $request->session()->flash('message', 'Kerkesa nuk juaj eshte aprovuar. Ju lutem kontaktoni menaxherin e Neutron');
                $request->session()->flash('alert-type', 'error');
            }
        }


        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $user = Auth::user();

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()){
            return response()->json(['errors' => $val->messages()]);
        }


        $validator =  Validator::make($request->only(['serial_number','new_serial_number']), [
            'serial_number' => ['required','exists:articles,sn',function ($attribute, $value, $fail) use ($user) {

                $article = Article::select('articles.id')->leftJoin('hshpikats','articles.id', '=', 'hshpikats.artikull_id')
                    ->where('sn','=',$value)
                    ->where('hshpikats.HSH', 'SH')
                    ->where('hshpikats.id_pika', $user->office_id)
                    ->first();

                if (!$article){
                    $fail('Nuk ekziston asnje artikull me kte serial : '.$value);
                }

                $artikulli_ne_gjendje = Hshpikat::where('artikull_id','=',$article->id)->where('HSH','=','SH')
                    ->where('id_pika','=',$user->office_id)->first();

                if (!$artikulli_ne_gjendje){
                    $fail('Artikulli me kte serial : '.$value . ' nuk gjendet ne piken tuaj');
                }

            },],
            //'different:serial_number',
                'new_serial_number' => ['required','exists:articles,sn', function ($attribute, $value, $fail) use ($user){


                    $article = Article::select('articles.id')->leftJoin('hshpikats','articles.id', '=', 'hshpikats.artikull_id')
                        ->where('sn','=',$value)
                        ->where('hshpikats.HSH', 'H')
                        ->where('id_pika','=',$user->office_id)
                        ->first();

                    if ($article == null){
                        $fail('Nuk ekziston asnje artikull me kte serial : '.$value);
                    }else{
                        $artikulli_ne_gjendje = Hshpikat::where('artikull_id','=',$article->id)->where('HSH','=','H')
                            ->where('id_pika','=',$user->office_id)->first();

                        if ($artikulli_ne_gjendje == null ){
                            $fail('Artikulli i ri me kte serial : '.$value . ' nuk gjendet ne piken tuaj');
                        }
                    }
                },]
        ],[
            'serial_number.exists' => 'Nuk ekziston asnje artikull me kte serial',
            'new_serial_number.exists' => 'Nuk ekziston asnje artikull me kte serial',
            'new_serial_number.different' => 'Seriali i Dekoderit te ri duhet te jete i ndryshem nga Barkodi',
        ]);

        if ($validator->fails()) {

            if ($request->ajax()){
                return response()->json([
                    'errors' => $validator->messages(),
                    'success' => 'false'
                ]);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!$request->has('_validate')) {

            $pika_postare = Office::
                where('id','=',$user->office_id)->first();
            $request['user_id'] = $user->id;
            $request['user_name'] = $user->name;
            $request['office_name'] = $pika_postare->name;
            $request['postal_code'] = $pika_postare->postal_code;

            $article = Article::where('sn','=',$request['serial_number'])->first();
            $artikulliShitur = Hshpikat::where('artikull_id','=',$article->id)->where('HSH','=','SH')->first();
            $dataShitjes = Carbon::parse($artikulliShitur->dt_sh);$now = Carbon::now();

           // $diff = $dataShitjes->diffInDays($now);

//            if ($diff > 3) {
//                return Redirect::back()->withErrors(['Kujdes!!', 'Kanë kaluar 3 dite nga koha e kthimit te produktit. Ju lutem kontaktoni ne numrin e telefonit: 0682087050']);
//            }

            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                    'print' => 'true'
                ]);
        }
    }

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view('vendor.voyager.returns.edit', compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $user = Auth::user();

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $status = (KthimDekoderi::find($id) ) ? KthimDekoderi::find($id)->status : '' ;

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

        $office = Office::select('id')->where('postal_code', $request['postal_code'])->first();

        $article = Article::select('articles.*')->leftJoin('hshpikats','articles.id', '=', 'hshpikats.artikull_id')
            ->where('sn','=',$request['serial_number'])
            ->where('hshpikats.HSH', 'SH')
            ->where('hshpikats.id_pika', $office->id)
            ->first();

//        dd($article);

//        $artikulliShitur = Hshpikat::where('artikull_id','=',$article->id)->where('HSH','=','SH')->first();
//        $dataShitjes = Carbon::parse($artikulliShitur->dt_sh);$now = Carbon::now();

        $artikulli_zv = Article::select('articles.*')->leftJoin('hshpikats','articles.id', '=', 'hshpikats.artikull_id')
            ->where('sn','=',$request['new_serial_number'])
            ->where('hshpikats.HSH', 'H')
            ->where('hshpikats.id_pika', $office->id)
            ->first();
//        dd($artikulli_zv->id);

            if($request->status == 'aprovuar' && $status == 'ne_pritje'){
//                dd($request->status);

                if($artikulli_zv) {

                    DB::table('hshpikats as sh')
                        ->where('sh.artikull_id', $artikulli_zv->id)->update(array('HSH' => 'SH','id_user' => $request->user_id,'dt_sh' => Carbon::now()));


                    $newArticle = new Article();
                    $newArticle->sn = $article->sn;
                    $newArticle->emertimet = $article->emertimet;
                    $newArticle->transferuar = '1';
                    $newArticle->Cmimi = -2940;
                    $newArticle->created_at = Carbon::now();
                    $newArticle->updated_at = Carbon::now();
                    $newArticle->save();


                    $hyrjeNePika = new Hshpikat();
                    $hyrjeNePika->HSH = 'K';
                    $hyrjeNePika->dt =  Carbon::now();
                    $hyrjeNePika->dt_sh =  Carbon::now();
                    $hyrjeNePika->artikull_id = $newArticle->id;
                    $hyrjeNePika->qyteti = 'NA';
                    $hyrjeNePika->id_pika = $office->id;
                    $hyrjeNePika->id_user = $request->user_id;
                    $hyrjeNePika->save();
                }
            }



        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

            event(new BreadDataUpdated($dataType, $data));

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }

    public function checkIfApproved(Request $request ){
        if ($request->input('id')){
            $returned = KthimDekoderi::find($request->input('id'));
            if($returned->status == 'aprovuar'){
                return response()->json(['success' => true, 'data' => [
                    'approved' => 'true'
                ]]);
            }
        }

        return response()->json(['success' => true, 'data' => [
            'approved' => 'false'
        ]]);
    }

    public function printFatura(Request $request, $id){
        $user = Auth::user();
        $office =  Office::findOrFail($user->office_id);
        $kthime = KthimDekoderi::find($id);

        $post_office_name = $office->name;
        $user_details = $user->name;


        $artikujtPerShitje =  DB::table('articles')->select('sn','emertimet','Cmimi')
            ->where('sn',$kthime->new_serial_number)
            ->get();

        $totali = DB::table('articles')->select('Cmimi')
            ->where('sn',$kthime->new_serial_number)
            ->sum('Cmimi');

        return view('pos.print', compact('artikujtPerShitje' ,
            'totali' ,
            'post_office_name',
            'user_details'
        ));

    }

    public function checkForNew(Request $request){
        $kthime = KthimDekoderi::where('status', 'ne_pritje')->count();
        if ( $request->input('last') !== '0' && $request->input('last') < $kthime ){
            return response()->json([
                'success' => 'true',
                'data' => [
                    'new' => 'true',
                ]
            ]);
        }

        return response()->json([
            'success' => 'true',
            'data' => [
                'new' => 'false',
                'last' => $kthime
            ]
        ]);

    }


    public function reject(Request $request) {
//        if ($request->input('id')){
//        console.log($request);
            $returned = KthimDekoderi::findOrFail($request->id);
//            dd($returned);
//            if($returned->status == 'ne_pritje'){

        if ($returned) {
            $returned->status = 'refuzuar';
            $returned->save();
            return response()->json(['success' => true, 'data' => [
                'approved' => 'false'
            ]]);
        }else{
            return response()->json(['success' => true, 'data' => [
            'approved' => 'false'
        ]]);
        }

//            }
//        }

//        dd('failed');
//        return response()->json(['success' => true, 'data' => [
//            'approved' => 'false'
//        ]]);
    }


}
