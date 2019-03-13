<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Hdmq;
use Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransferController extends  \TCG\Voyager\Http\Controllers\Controller{

    public function index(Request $request){

        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $artikujt = DB::table('articles')->where('transferuar',0)->paginate(25);


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
            'sortOrder',
            'searchable',
            'isServerSide',
            'artikujt'
        ));
    }

    public function store(Request $request){

        $vlera = response()->json($request);

        $bodyContent = $vlera->getContent();

        $ln = strlen($bodyContent);
        $sub1 = substr($bodyContent, 10, $ln);

        $sub2 = substr($sub1, 0,-2);
        $sub2 = str_replace('"', "", $sub2);
        $sub2 = str_replace("'", "", $sub2);

        //$myString = "61,62,63,64";
        $myArray = explode(',', $sub2);

        for ($i = 0; $i < count($myArray); $i++) {
            Hdmq::create([
                'HD' => 'H',
                'dt' => Carbon::now(),
                'artikull_id' => $myArray[$i],
                'qyteti' => 'Tirane_MQ',
                'id_pika' => 1,
                'id_user' => 1
            ]);
            $id = $myArray[$i];
            Article::where('id', $id)->update(array('transferuar' => 1));
        }

        return $vlera;

    }

}