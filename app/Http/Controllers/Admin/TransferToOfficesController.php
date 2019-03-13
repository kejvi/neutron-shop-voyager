<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Hdmq;
use App\Hshpikat;
use Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransferToOfficesController extends  \TCG\Voyager\Http\Controllers\Controller {

    public function index(Request $request){

        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));


        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        $artikujt = DB::table('hdmqs as h')
            ->leftJoin('articles as a', 'h.artikull_id', '=', 'a.id')
            ->select('h.id','h.HD','a.emertimet','a.sn','h.artikull_id','a.transferuar')
            ->where('a.transferuar', '=', 1)
            ->where('h.HD', '=', 'H')
            ->get();

        $branches =   Branch::orderBy('name')->get();

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'sortOrder',
            'searchable',
            'isServerSide',
            'artikujt',
            'branches'
        ));
    }

    public function store(Request $request){
        $vlera = response()->json($request);

        $user = Auth::user();
        $bodyContent = $vlera->getContent();

        $ln = strlen($bodyContent);
        $sub1 = substr($bodyContent, 10, $ln);

        $sub2 = substr($sub1, 0,-2);
        $sub2 = str_replace('"', "", $sub2);
        $sub2 = str_replace("'", "", $sub2);

        $myArray = explode(',', $sub2);
        $qyteti = $myArray[0];
        $pika = $myArray[1];

        for ($i = 2; $i < count($myArray); $i++) {
            Hdmq::where('artikull_id', $myArray[$i])
                ->update(array(
                    'HD' => 'D',
                    'qyteti' => $qyteti,
                    'id_pika' => $pika,
                    'id_user' => $user->id
                ));

            Hshpikat::create([
                'HSH' => 'H',
                'artikull_id' => $myArray[$i],
                'qyteti' => $qyteti,
                'id_pika' => $pika,
                'id_user' => $user->id,
                'dt' => Carbon::now(),
            ]);
        }

        return $vlera;
    }

}