<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Office;
use App\Site;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class TotalReportMonitoringController extends  VoyagerBaseController {


    public function index(Request $request)
    {
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $view = 'voyager::bread.browse';

//        $user = Auth::user();
        $date_stmt = null;
        $monthFirstDate = null;
        $monthEndDate = null;

        $offices_stmt = '';
        $table = [];
        //Check the date range
        if($request->input('daterange')){
            $date_stmt = "AND DATE(hshpikats.dt_sh) >= 'fdate' AND  DATE(hshpikats.dt_sh) <= 'edate'";

            $fdate = explode(' - ' , $request->input('daterange'))[0];
            $edate = explode(' - ' , $request->input('daterange'))[1];

            $monthFirstDate = $fdate;
            $monthEndDate = $edate;

            $fdate =  Carbon::createFromFormat('d/m/Y', $fdate)->format('Y-m-d');
            $edate =  Carbon::createFromFormat('d/m/Y', $edate)->format('Y-m-d');

            $date_stmt =  str_replace('fdate', $fdate, $date_stmt);
            $date_stmt =  str_replace('edate', $edate, $date_stmt);
        }

        $offices = Office::query();

        if ($request->input('site')){
            $filter_site = Site::where('name' , $request->input('site'))->first();
            $filter_site_branches = Branch::where('site_id', $filter_site->id)->get();
            $filter_site_branches_ids = $filter_site_branches->pluck('id')->all();

            $offices_stmt .= " AND offices.branch_id IN(".implode(',', $filter_site_branches_ids).")";
//            $site = Site::where('slug' , $request->input('site'))->first();
//            $branches = Branch::where('site_id', $site->id)->get();
//            $branchIds = $branches->pluck('id')->all();
//            $offices->whereIn('branch_id' , $branchIds );
        }

        if ($request->input('branch')){
            $filter_branch = Branch::where('name', $request->input('branch') )->first();
            $offices_stmt .= " AND offices.branch_id = ".$filter_branch->id." ";
//            $branch = Branch::where('slug', $request->input('branch') )->first();
//            $offices->where('branch_id' , $branch->id );
        }
        $sites = DB::select(DB::raw('
            SELECT
              branches.name AS dega,
              sites.name AS filiali,
              sites.id AS filiali_id,
              articles.Cmimi AS cmimi,
              COUNT(hshpikats.id) AS dergesa,
              COUNT(IF(hshpikats.HSH = \'H\',
              1,
              NULL)) AS hyrje,
              COUNT(IF(hshpikats.HSH = \'SH\',
              1,
              NULL)) AS shitje,
              COUNT(IF(hshpikats.HSH = \'K\',
              1,
              NULL)) AS kthime,
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek,
              SUM(IF(hshpikats.HSH=\'K\',articles.Cmimi,NULL) ) as lek_kthyer
            FROM
              offices
            LEFT JOIN
              branches ON offices.branch_id = branches.id
            LEFT JOIN
              sites ON branches.site_id = sites.id
            LEFT JOIN
              hshpikats ON hshpikats.id_pika = offices.id
            LEFT JOIN
              articles ON hshpikats.artikull_id = articles.id
              WHERE 1=1   
              '.$offices_stmt.'
              '.$date_stmt.'
            GROUP BY
              sites.id HAVING filiali != "" '));


        $sites_pa_date = DB::select(DB::raw('
            SELECT
               branches.name AS dega,
              sites.name AS filiali,
              sites.id AS filiali_id,
              COUNT(hshpikats.id) AS dergesa,
              COUNT(IF(hshpikats.HSH = \'K\',
              1,
              NULL)) AS kthime
            FROM
              offices
            LEFT JOIN
              branches ON offices.branch_id = branches.id
            LEFT JOIN
              sites ON branches.site_id = sites.id
            LEFT JOIN
              hshpikats ON hshpikats.id_pika = offices.id
            LEFT JOIN
              articles ON hshpikats.artikull_id = articles.id
              WHERE 1=1   
              '.$offices_stmt.'
            GROUP BY
              sites.id HAVING filiali != "" '));


        // $sites_assoc = [];
        $table['total_shitur'] = 0;
        $table['dergesa'] = 0;
        $table['gjendje'] = 0;
        $table['kthime'] = 0;
        $table['leke'] = 0;

        foreach ($sites_pa_date as $site_pa_date) {
            $site_total_received = $site_pa_date->dergesa - $site_pa_date->kthime;
            $table['dergesa'] += $site_total_received;
        }

        foreach ($sites as $site){
            //  $sites_assoc[$site->filiali_id][] = $site;
            /**
             * Enea Dume
             * 11-01-2019
             * Bej zbritje kthimet nga shitjet dhe nga totali i filialeve
             */
            $site_sales = $site->shitje - $site->kthime;
//            $site_total_received = $site->dergesa - $site->kthime;
            //totalet e filialit
//            $table[strtolower($site->filiali)]['shitur'] = $site_sales;
//            $table[strtolower($site->filiali)]['hyrje'] = $site->hyrje;
//            $table[strtolower($site->filiali)]['dergesa'] =  $site_total_received;
//            $table[strtolower($site->filiali)]['kthime'] = $site->kthime;
            $table['total_shitur'] +=  $site_sales;
//            $table['dergesa'] += $site_total_received;
            $table['gjendje'] += $site->hyrje;
            $table['kthime'] += $site->kthime;
            $table['leke'] += $site->lek + $site->lek_kthyer;
        }
        $offices = $offices->select('id')->get();

//        if ($offices->count()){
//
////            $offices->pluck('id');
////            $dergesa = DB::table('hshpikats')->get()->count();
////            dd($dergesa);
//            $dergesa = DB::table('hshpikats')
//                ->where(function ($query) {
//                $query->where('hshpikats.HSH','=','SH')
//                    ->orWhere('hshpikats.HSH','=','H');
//            })
//                ->whereIn('id_pika',$offices->pluck('id')->toArray());
////            dd($dergesa->count());
//
//            if ($monthFirstDate !== null && $monthEndDate !== null){
//                $fdate =  Carbon::createFromFormat('d/m/Y', $monthFirstDate)->format('Y-m-d H:i:s');
//                $edate =  Carbon::createFromFormat('d/m/Y', $monthEndDate)->format('Y-m-d H:i:s');
//
//                $dergesa->where('dt', '>=' , $fdate)
//                    ->where('dt', '<=' , $edate);
//            }
//
//            $dergesa = $dergesa->count();
////            dd($dergesa);
//
//            $totalShitur = DB::table('hshpikats')
//                ->where('HSH','SH')
//                ->whereIn('id_pika',$offices->pluck('id')->toArray());
//
//            if ($monthFirstDate !== null && $monthEndDate !== null){
//                $fdate =  Carbon::createFromFormat('d/m/Y', $monthFirstDate)->format('Y-m-d H:i:s');
//                $edate =  Carbon::createFromFormat('d/m/Y', $monthEndDate)->format('Y-m-d H:i:s');
//
//                $totalShitur->where('dt_sh', '>=' , $fdate)
//                    ->where('dt_sh', '<=' , $edate);
//            }
//
//
//
//            $gjendja = DB::table('hshpikats')
//                ->where('HSH','H')
//                ->whereIn('id_pika',$offices->pluck('id')->toArray());
//
//            if ($monthFirstDate !== null && $monthEndDate !== null){
//                $fdate =  Carbon::createFromFormat('d/m/Y', $monthFirstDate)->format('Y-m-d H:i:s');
//                $edate =  Carbon::createFromFormat('d/m/Y', $monthEndDate   )->format('Y-m-d H:i:s');
//
//                $gjendja->where('dt', '>=' , $fdate)
//                    ->where('dt', '<=' , $edate);
//            }
//
//
//
//
//            $totalKthyer = DB::table('hshpikats')
//                ->where('HSH','K')
//                ->whereIn('id_pika',$offices->pluck('id')->toArray());
//
//            if ($monthFirstDate !== null && $monthEndDate !== null){
//                $fdate =  Carbon::createFromFormat('d/m/Y', $monthFirstDate)->format('Y-m-d H:i:s');
//                $edate =  Carbon::createFromFormat('d/m/Y', $monthEndDate)->format('Y-m-d H:i:s');
//
//                $totalKthyer->where('dt_sh', '>=' , $fdate)
//                    ->where('dt_sh', '<=' , $edate);
//            }
//
//        }

        $totalKthyer =  $table['kthime'];
        $dergesa =  $table['dergesa'];
        $gjendja = $table['gjendje'];
        $total_leke = $table['leke'];

        $totalShitur = $table['total_shitur'];
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }


        $sites = Site::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        $selectedSite = $request->input('site');
        $selectedBranch = $request->input('branch');

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'offices',
            'monthFirstDate',
            'monthEndDate',
            'sites',
            'branches',
            'selectedBranch',
            'selectedSite',
            'dergesa',
            'gjendja',
            'totalShitur',
            'totalKthyer',
            'total_leke'
        ));
    }





}