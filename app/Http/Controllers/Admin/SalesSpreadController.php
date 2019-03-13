<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Article;
use App\Branch;
use App\Client;
use App\Hshpikat;
use function GuzzleHttp\Psr7\try_fopen;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Validator;

class SalesSpreadController  extends  \TCG\Voyager\Http\Controllers\Controller
{

    public  function  import() {
        $user = Auth::user();
        if ($user){
            if ($user->id !== 1){
                abort(403);
            }
        }else{
            abort(403);
        }
        return view('salesSpread.index');
    }


    public  function upload(Request $request) {
        $user = Auth::user();

        if ($user){
            if ($user->id !== 1){
                abort(403);
            }
        }else{
            abort(403);
        }
        $this->validate($request,[
            'file' => 'required|mimes:csv,txt'
        ]);

        $not_found_sn = [];

        if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== false)
        {
            fgetcsv($handle);
            while(($data = fgetcsv($handle, 100000, ",")) !== false) {

                //gjej id e pikes postare sipas kodit perkates
                $id_pikaPostare = DB::table('offices')->where('postal_code', '=', $data[2])->first();

                $hsh_id = DB::table('articles as a')->select('sh.id')
                    ->leftJoin('hshpikats as sh', 'sh.artikull_id', '=', 'a.id')
                    ->where('a.sn', '=', $data[0])
                    ->where('HSH', '=', 'H')->where('id_pika', '=', $id_pikaPostare->id)->first();


                if ($hsh_id){
                    $hsh = Hshpikat::find($hsh_id->id);
                    $hsh->HSH = 'SH';
                    $hsh->dt_sh = $data[1];
                    $hsh->save();
                }else{
                    $not_found_sn[$hsh_id] = $data;
                }


            }


        }


        return redirect()->route('voyeager.import-sales')
            ->with('message', 'Perditesimi i artikujve u krye me sukses')
            ->with('articles_not_found', $not_found_sn);
    }
}
