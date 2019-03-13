<?php

namespace App\Http\Controllers\Admin;

use App\Hshpikat;
use App\Office;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use Voyager;
use  Auth;
use DB;
use Redirect;
use Validator;
use Carbon\Carbon;

class SalesManagerController extends VoyagerBaseController
{
    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
//        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $searchable = array_keys(Hshpikat::leftJoin('articles', function($join) {
            $join->on('hshpikats.artikull_id', '=', 'articles.id');
        })->first()->toArray());


//        $c = array_keys(SchemaManager::describeTable(Hshpikat::leftJoin('articles', function($join) {
//            $join->on('hshpikats.artikull_id', '=', 'articles.id');
//        }))->toArray());
//        dd($c);
        $orderBy = $request->get('order_by');
        $sortOrder = $request->get('sort_order', null);

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
//            $relationships = $this->getRelationships($dataType);

            $model = app($dataType->model_name);

            $query = Hshpikat::leftJoin('articles as a', 'hshpikats.artikull_id', '=', 'a.id')
                ->select('hshpikats.*', 'a.sn');
            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'DESC';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest('hshpikats.created_at'), $getter]);
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

        $view = 'vendor.voyager.hshpikat.browse';//'voyager::bread.browse';

//        if (view()->exists("voyager::$slug.browse")) {
//            $view = "voyager::$slug.browse";
//        }

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'sortOrder',
            'searchable',
            'isServerSide'
        ));
    }

    public function  transfer(Request $request) {
//        dd($request);
//        $slug = $this->getSlug($request);

//        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        $ids = [];
        $postal_code = $request->postal_code;
        $user = Auth::user();
        $office = Office::where('postal_code', $postal_code)->first();
//        dd($postal_code);
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }
//        dd($ids);
        if ($office) {
            foreach ($ids as $id) {
                $hsh = Hshpikat::findOrFail($id);
                $hsh->id_pika_ardhur = $hsh->id_pika;
                $hsh->id_user_transfer = $user->id;
                $hsh->id_pika = $office->id;
                $hsh->data_transferimit = Carbon::now();
                $hsh->save();
            }
        }else{
            $data = [
                'message'    => 'Kujdes! Kjo zyre postare nuk ekziston.',
                'alert-type' => 'error',
            ];

            return Redirect::back()->with($data);
        }

        $data = [
            'message'    => 'Artikujt u transferuan me sukses',
            'alert-type' => 'success',
        ];

       return Redirect::back()->with($data);
//        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

}

