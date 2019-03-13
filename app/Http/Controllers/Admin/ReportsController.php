<?php
/**
 * Created by PhpStorm.
 * User: eneadume
 * Date: 29/11/2018
 * Time: 14:05
 */


namespace App\Http\Controllers\Admin;

use App\Article;
use App\Branch;
use App\Client;
use App\Hshpikat;
use App\Office;
use function GuzzleHttp\Psr7\try_fopen;
use Illuminate\Http\Request;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Validator;

class ReportsController extends  \TCG\Voyager\Http\Controllers\Controller {

    /**
     * used to make daily reports. only daily
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    function makeDailyReport()
    {
        $user = Auth::user();
        $office =  Office::findOrFail($user->office_id);
        $artikujt_e_shitur =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')
            ->whereDate('sh.dt_sh', Carbon::today())
            ->where('sh.id_user','=',$user->id)
            ->where(function ($query) {
                $query->where('sh.HSH','=','SH')
                    ->orWhere('sh.HSH','=','K');
            })->get();

        $totaliDites = $this->getTotaliFatures();
        return view('pos.dailyReport', ['artikujt' => $artikujt_e_shitur, 'totali' => $totaliDites, 'user' => $user->name, 'office' => $office->name]);
    }

    /**
     * marr totalin e fatures per ta printuar
     * @return mixed
     */
    public function getTotaliFatures()
    {
        $user = Auth::user();
//        $totali  = DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
//            ->where('sh.HSH','=','SH')->where('sh.id_user','=',$user->id)->sum('Cmimi');
        $totali =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')
            ->whereDate('sh.dt_sh', Carbon::today())
            ->where('sh.id_user','=',$user->id)
            ->where(function ($query) {
                $query->where('sh.HSH','=','SH')
                    ->orWhere('sh.HSH','=','K');
            })->sum('Cmimi');
//        dd($totali);
        return $totali;
    }

    /**
     * marr totalin e fatures per ta printuar
     * @return mixed
     */
    public function getBalancaTotale()
    {
        $user = Auth::user();
//        $totali  = DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
//            ->where('sh.HSH','=','SH')->where('sh.id_user','=',$user->id)->sum('Cmimi');
        $totali =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')
//            ->whereDate('sh.dt_sh', Carbon::today())
            ->where('sh.id_user','=',$user->id)
            ->where("id_pika", $user->office_id)
            ->where(function ($query) {
                $query->where('sh.HSH','=','SH')
                    ->orWhere('sh.HSH','=','K');
            })->sum('Cmimi');
//        dd($totali);
        return $totali;
    }

    function makeMonthlyReports()
    {
        $user = Auth::user();
        $office =  Office::findOrFail($user->office_id);

        $artikujt_e_shitur =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')
//            ->whereDate('sh.dt_sh', Carbon::today())
            ->where('sh.id_user','=',$user->id)
            ->where("id_pika", $user->office_id)
            ->where(function ($query) {
                $query->where('sh.HSH','=','SH')
                    ->orWhere('sh.HSH','=','K');
            })->get();
//        $artikujt_e_shitur =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
//            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')->where('sh.HSH','=','SH')->where('sh.id_user','=',$user->id)->get();

        $totaliDites = $this->getBalancaTotale();
        return view('pos.allReports', ['artikujt' => $artikujt_e_shitur, 'totali' => $totaliDites, 'user' => $user->name, 'office' => $office->name]);
    }

    public function upload(Request $request){
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
        if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== false)
        {
            fgetcsv($handle);
            while(($data = fgetcsv($handle, 100000, ",")) !== false)
            {

                //kontrolloj per siguri nqs ekziston nje artikull me serial qe po mundohemi te inserojme.
                $existingArticles = Article::where('sn', '=', $data[0])->first();

//                dd($existingArticles);
                if ($existingArticles !== null && $existingArticles->sn !== '6958917601299' )
                {
                    //do nothing because article extist
//                    dd('failed with error: artikulli ekziston');
                }else{
                    $article = new Article();
                    //ruaj artikullin me te dhena nga nje file excel
                    $article->sn = $data[0];
                    $article->emertimet = $data[1];
                    $article->transferuar = '1';
                    $article->Cmimi = '2940';
                    $article->created_at = $data[3];
                    $article->updated_at = $data[3];
                    $article->save();
                    //kryej transferimin neper pika sipas excelit te ngarkuar
                    $id_pikaPostare = DB::table('offices')->select('id')->where('postal_code', '=', $data[2])->first();
                    //kontrolloj nqs ekziston ne db pika postare ku do te behet shperndarja
                    if($id_pikaPostare)
                    {
                        $hyrjeNePika = new Hshpikat();
                        $hyrjeNePika->HSH = 'H';
                        $hyrjeNePika->dt =  $data[3];
                        $hyrjeNePika->artikull_id = $article->id;
                        $hyrjeNePika->qyteti = 'NA';
                        $hyrjeNePika->id_pika = $id_pikaPostare->id;
                        $hyrjeNePika->id_user = '1';
                        $hyrjeNePika->save();
                    }else{
                        DB::table('missing_offices')->insert([
                            'postal_code' => $data[2],
                            'created_at' => $data[3],
                            'updated_at' => $data[3]
                        ]);
                    }
                }
            }
        }
       return redirect()->route('voyeager.import')->with('message', 'Artikujt u ngarkuan dhe u shperndane me sukses neper pika postare');
    }

    public function import()
    {
        $user = Auth::user();

        if ($user){
            if ($user->id !== 1){
                abort(403);
            }
        }else{
            abort(403);
        }
        return view('upladexcel');
    }

    public function reprint($id)
    {
        return $id;
    }

    public function printDailyBill()
    {
        $user = Auth::user();
        $user_details = $user->name;

        $office =  Office::findOrFail($user->office_id);
        $post_office_name = $office->name;


        $artikujtPerShitje =  DB::table('hshpikats as sh') ->leftJoin('articles as a', 'sh.artikull_id', '=', 'a.id')
            ->select('a.emertimet','a.sn','sh.artikull_id', 'a.Cmimi')
            ->whereDate('sh.dt_sh', Carbon::today())
            ->where('sh.id_user','=',$user->id)
            ->where(function ($query) {
                $query->where('sh.HSH','=','SH')
                    ->orWhere('sh.HSH','=','K');
            })->get();

        $totali = $this->getTotaliFatures();

        return view('pos.print', compact('artikujtPerShitje' ,
        'totali' ,
        'post_office_name',
        'user_details'
    ));
    }

}
//$offices = Office::all();
//
//foreach ($offices as $o){
//    $branch = Branch::find($o->branch_id);
//
//    $o->name = $o->name." ( ". $branch->name ." )";
//
//    $o->save();