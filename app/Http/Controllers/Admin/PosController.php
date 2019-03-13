<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Office;
use Complex\Exception;
use Illuminate\Http\Request;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Validator;

class PosController extends  \TCG\Voyager\Http\Controllers\Controller {

    public function index(Request $request){
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $user = Auth::user();

        if (!$user->office_id){
            abort(403);
        }

        $office =  Office::findOrFail($user->office_id);
        $postal_code = $office->postal_code;

        $artikujt = DB::table('hshpikats as sh')
            ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('sh.id','sh.HSH','a.emertimet','a.sn','sh.artikull_id','a.transferuar', 'a.Cmimi')
            ->where('sh.HSH','=','H')
            ->where('sh.id_pika','=',$user->office_id)
            ->paginate(12);

        $artikujtPerShitje =  DB::table('temp_shitjet')->select('sn','emertimi','cmimi')
            ->where('user_id',$user->id)
            ->get();

        $totali = DB::table('temp_shitjet')->select('cmimi')
            ->where('user_id',$user->id)
            ->sum('Cmimi');


        return view('pos.index', [
            'artikujt' => $artikujt,
            'artikujtPerShitje' => $artikujtPerShitje,
            'post_office_name' => $office->name,
            'user_details' => $user->name,
            'totali' => $totali
            ]);
    }

    public function store( Request $request){
        $id = request('sn');

        $user = Auth::user();

        $artikujtPerShitje =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')->where('a.sn','=',$id)
            ->where('sh.HSH','=','H')
            ->where('sh.id_pika','=',$user->office_id)->first();

        if ($artikujtPerShitje){
            $sn = $artikujtPerShitje->sn;
            $emri = $artikujtPerShitje->emertimet;
            $cmimi = $artikujtPerShitje->Cmimi;
            $product_id = $artikujtPerShitje->artikull_id;

            DB::insert('insert into temp_shitjet (sn, product_ID, emertimi, cmimi, user_id) values (?, ?, ?, ?,?)', [$sn,$product_id, $emri, $cmimi, $user->id]);
        }else{
            return redirect()->route('voyager.pos.index')->with('message', 'Artikulli nuk gjendet ne piken tuaj postare. Ju lutem konaktoni administratorin');
        }

        return redirect()->route('voyager.pos.index');
    }

    public function destroy($id)
    {
        DB::table('temp_shitjet')->where('sn', '=', $id)->delete();
        return redirect()->route('voyager.pos.index');
    }

    public function ruajArtikujtEShitur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'nullable|email',
            'address' => 'nullable|min:6',
            'tel' => 'nullable|numeric',
        ]);

        $clientSaved = false;

        $artikujtEShitur = $this->get_customer_data();
        $user = Auth::user();

        foreach ($artikujtEShitur as $artikull)
        {
            try{
                if (!$validator->fails()) {
                    //save  client
                    $client = new Client();
                    $client->first_name =  $request->first_name;
                    $client->last_name =  $request->last_name;
                    $client->address =  $request->address;
                    $client->tel =  $request->tel;
                    $client->sn = $artikull->sn;

                    if ($request->email){
                        $client->email =  $request->email;
                    }

                    $client->save();

                    $clientSaved = true;
                }

            }catch (Exception $exception){

            }finally {
                $id_artikull = $artikull->product_ID;

                DB::table('hshpikats as sh')
                    ->where('sh.artikull_id', $id_artikull)->update(array('HSH' => 'SH','id_user' => $user->id,'dt_sh' => Carbon::now()));

                DB::table('temp_shitjet')->where('product_ID', '=', $id_artikull)->delete();
            }

        }

        return redirect()->route('voyager.pos.index')->with('message', 'Shitja u krye me sukses');
    }

    function get_customer_data()
    {
        $user = Auth::user();
        $artikujtPerShitje =  DB::table('temp_shitjet')->select('sn','emertimi','cmimi', 'product_ID')->where('user_id','=',$user->id)->get();
        return $artikujtPerShitje;
    }

    function printFatura(){
        $user = Auth::user();
        $office =  Office::findOrFail($user->office_id);

        $post_office_name = $office->name;
        $user_details = $user->name;

        $artikujtPerShitje =  DB::table('temp_shitjet')->select('sn','emertimi','Cmimi')
            ->where('user_id',$user->id)
            ->get();

        $totali = DB::table('temp_shitjet')->select('cmimi')
            ->where('user_id',$user->id)
            ->sum('Cmimi');

        return view('pos.print', compact('artikujtPerShitje' ,
            'totali' ,
            'post_office_name',
            'user_details'
            ));
    }
}