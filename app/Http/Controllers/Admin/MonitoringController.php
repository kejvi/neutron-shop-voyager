<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Office;
use App\Site;
use App\User;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Excel;
use Illuminate\Support\Collection;

class MonitoringController extends  VoyagerBaseController {

    public function index(Request $request){
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $view = 'voyager::bread.browse';

        $user = Auth::user();

        $monthFirstDate = null;
        $monthEndDate = null;

        $date_stmt = null;

        $table = [];

        $offices_stmt = '';
        $office_ids = [];

        if($user->hasRole('admin')){
        }

        if($user->hasRole('Kryetar Zyre')){
            if (!$user->office_id){
                abort(403);
            }
            $offices_stmt .= " AND offices.id =  ".$user->office_id;
        }

        if($user->hasRole('Specialist në Degë')){
            if (!$user->branch_id){
                abort(403);
            }

            $office_ids = Office::where('branch_id', $user->branch_id)->get();
            $office_ids = $office_ids->pluck('id')->all();
            $offices_stmt .= "AND offices.id IN(".implode(',', $office_ids).")";
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                abort(403);
            }

            $branch_ids = Branch::where('site_id' ,  $user->site_id)->get();
            $office_ids = Office::whereIn('branch_id', $branch_ids->pluck('id')->all() )->get();

            $office_ids = $office_ids->pluck('id')->all();
            $offices_stmt .= " AND offices.id IN(".implode(',', $office_ids).")";
        }

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

        if ($request->input('site')){
            $filter_site = Site::where('id' , $request->input('site'))->first();
            $filter_site_branches = Branch::where('site_id', $filter_site->id)->get();
            $filter_site_branches_ids = $filter_site_branches->pluck('id')->all();

            $offices_stmt .= " AND offices.branch_id IN(".implode(',', $filter_site_branches_ids).")";
        }

        if ($request->input('branch')){
            $filter_branch = Branch::where('id', $request->input('branch') )->first();
            $offices_stmt .= " AND offices.branch_id = ".$filter_branch->id." ";
        }

        if ($request->input('zyrat')){
            $filter_office = Office::where('id', $request->input('zyrat') )->first();
            $offices_stmt .= " AND offices.id = ".$filter_office->id." ";
        }

        if ($request->input('users')){
            $offices_stmt .= " AND hshpikats.id_user = ".$request->input('users')." ";
        }

        $offices = DB::select(DB::raw('
            SELECT
             LOWER(offices.slug) as zyra,
              LOWER(branches.slug) AS dega,
              offices.id as zyra_id,
              sites.name AS filiali,
               sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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
              offices.id
              '));

        foreach ($offices as $office){
            $office_ids[]  = $office->zyra_id;

            /**
             * Enea Dume
             * 11-01-2019
             * Bej zbritje kthimet nga shitjet dhe nga totali i zyrave
             */
            $office_sales = $office->shitje - $office->kthime;
            $office_total_received = $office->dergesa - $office->kthime;
            $office_total_money_from_sales = $office->lek - $office->kthime * 2940;

            //totalet e filialit
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['shitur'] =  $office_sales;//$office->shitje;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['hyrje'] = $office->hyrje;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['dergesa'] =  $office_total_received;//$office->dergesa;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['kthime'] = $office->kthime;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['lek'] =  $office_total_money_from_sales;//$office->lek;
        }

        $sites = DB::select(DB::raw('
            SELECT
              branches.name AS dega,
              sites.name AS filiali,
              sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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

       // $sites_assoc = [];
        foreach ($sites as $site){
          //  $sites_assoc[$site->filiali_id][] = $site;
            /**
             * Enea Dume
             * 11-01-2019
             * Bej zbritje kthimet nga shitjet dhe nga totali i filialeve
             */
            $site_sales = $site->shitje - $site->kthime;
            $site_total_received = $site->dergesa - $site->kthime;
            $site_total_money_from_sales = $site->lek - $site->kthime * 2940;
            //totalet e filialit
            $table[strtolower($site->filiali)]['shitur'] = $site_sales;//$site->shitje;
            $table[strtolower($site->filiali)]['hyrje'] = $site->hyrje;
            $table[strtolower($site->filiali)]['dergesa'] =  $site_total_received;//$site->dergesa;
            $table[strtolower($site->filiali)]['kthime'] = $site->kthime;
            $table[strtolower($site->filiali)]['lek'] = $site_total_money_from_sales;//$site->lek;
        }


        $branches = DB::select(DB::raw('
            SELECT
              branches.name AS dega,
              branches.id AS dega_id,
              sites.name AS filiali,
              sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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
              branches.id HAVING filiali != ""'));


       // $branches_assoc = [];
        foreach ($branches as $branch){
            //$branches_assoc[$branch->dega_id][] = $branch;
            /**
             * Enea Dume
             * 11-01-2019
             * Bej zbritje kthimet nga shitjet dhe nga totali i degeve
             */
            $branch_sales = $branch->shitje - $branch->kthime;
            $branch_total_received = $branch->dergesa - $branch->kthime;
            $branch_total_money_from_sales = $branch->lek - $branch->kthime * 2940;

            //totalet e filialit
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['shitur'] =  $branch_sales;// $branch->shitje;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['hyrje'] = $branch->hyrje;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['dergesa'] =  $branch_total_received;// $branch->dergesa;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['kthime'] = $branch->kthime;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['lek'] =  $branch_total_money_from_sales;//$branch->lek;
        }

        $users = DB::select(DB::raw('
             SELECT
              users.username,
              offices.postal_code,
              LOWER(offices.slug) as zyra,
              LOWER(branches.slug) AS dega,
              LOWER(sites.slug) AS filiali,
              SUM(
                IF(
                  hshpikats.HSH = \'SH\',
                  articles.Cmimi,
                  0
                )
              ) AS lek,
              COUNT(IF(hshpikats.HSH = \'K\',
              1,
              NULL)) AS kthime,
              COUNT(
                IF(
                  hshpikats.HSH = \'SH\',
                  hshpikats.id,
                  NULL
                )
              ) AS produkte
            FROM
              users
            LEFT JOIN
              hshpikats ON hshpikats.id_user = users.id
            LEFT JOIN
              articles ON hshpikats.artikull_id = articles.id
            LEFT JOIN
              offices ON users.office_id = offices.id
            LEFT JOIN
              branches ON branches.id = offices.branch_id
            LEFT JOIN
              sites ON sites.id = branches.site_id
              WHERE 1=1 
              '.$offices_stmt.'
              '.$date_stmt.'
            GROUP BY
              users.id
              HAVING zyra != ""'));

        foreach ($users as $user){
            /**
             * Enea Dume
             * 11-01-2019
             * Bej zbritje kthimet nga shitjet dhe nga totali per cdo user
             */
            $user_sales = $user->produkte - $user->kthime;
            $user_total_money_from_sales = $user->lek - $user->kthime * 2940;

            //totalet e filialit
            $table[strtolower($user->filiali)]['deget'][strtolower($user->dega)]['zyrat'][strtolower($user->zyra)]['users'][$user->username]['shitur'] =  $user_total_money_from_sales;// $user->lek;
            $table[strtolower($user->filiali)]['deget'][strtolower($user->dega)]['zyrat'][strtolower($user->zyra)]['users'][$user->username]['produkte'] = $user_sales;//$user->produkte;

        }


        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }


        $sites = Site::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();

        $selectedSite = ($request->input('site')) ? Site::find($request->input('site')) : '';
        $selectedBranch = ($request->input('branch')) ? Branch::find($request->input('branch')) : '';
        $selectedZyra = ($request->input('zyrat')) ? Office::find($request->input('zyrat')) : '';
        $selectedUser = ($request->input('users')) ? User::find($request->input('users')) : '';



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
            'selectedZyra',
            'selectedUser',
            'table'
        ));
    }

    public function exportWithBarcodes(Request $request){
        $user = Auth::user();

        $monthFirstDate = null;
        $monthEndDate = null;

        $date_stmt = null;

        $table = [];

        $offices_stmt = '';
        $office_ids = [];

        if($user->hasRole('admin')){
        }

        if($user->hasRole('Kryetar Zyre')){
            if (!$user->office_id){
                abort(403);
            }
            $offices_stmt .= " AND offices.id =  ".$user->office_id;
        }

        if($user->hasRole('Specialist në Degë')){
            if (!$user->branch_id){
                abort(403);
            }

            $office_ids = Office::where('branch_id', $user->branch_id)->get();
            $office_ids = $office_ids->pluck('id')->all();
            $offices_stmt .= "AND offices.id IN(".implode(',', $office_ids).")";
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                abort(403);
            }

            $branch_ids = Branch::where('site_id' ,  $user->site_id)->get();
            $office_ids = Office::whereIn('branch_id', $branch_ids->pluck('id')->all() )->get();

            $office_ids = $office_ids->pluck('id')->all();
            $offices_stmt .= " AND offices.id IN(".implode(',', $office_ids).")";
        }

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

        if ($request->input('site')){
            $filter_site = Site::where('id' , $request->input('site'))->first();
            $filter_site_branches = Branch::where('site_id', $filter_site->id)->get();
            $filter_site_branches_ids = $filter_site_branches->pluck('id')->all();

            $offices_stmt .= " AND offices.branch_id IN(".implode(',', $filter_site_branches_ids).")";
        }

        if ($request->input('branch')){
            $filter_branch = Branch::where('id', $request->input('branch') )->first();
            $offices_stmt .= " AND offices.branch_id = ".$filter_branch->id." ";
        }

        if ($request->input('zyrat')){
            $filter_office = Office::where('id', $request->input('zyrat') )->first();
            $offices_stmt .= " AND offices.id = ".$filter_office->id." ";
        }

        if ($request->input('users')){
            $offices_stmt .= " AND hshpikats.id_user = ".$request->input('users')." ";
        }

        $offices = DB::select(DB::raw('
            SELECT
             LOWER(offices.slug) as zyra,
              LOWER(branches.slug) AS dega,
              offices.id as zyra_id,
              sites.name AS filiali,
               sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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
              offices.id
              '));

        foreach ($offices as $office){
            $office_ids[]  = $office->zyra_id;

            //totalet e filialit
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['shitur'] = $office->shitje;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['hyrje'] = $office->hyrje;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['dergesa'] = $office->dergesa;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['kthime'] = $office->kthime;
            $table[strtolower($office->filiali)]['deget'][strtolower($office->dega)]['zyrat'][strtolower($office->zyra)]['lek'] = $office->lek;
        }

        $sites = DB::select(DB::raw('
            SELECT
              branches.name AS dega,
              sites.name AS filiali,
              sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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

        // $sites_assoc = [];
        foreach ($sites as $site){
            //  $sites_assoc[$site->filiali_id][] = $site;

            //totalet e filialit
            $table[strtolower($site->filiali)]['shitur'] = $site->shitje;
            $table[strtolower($site->filiali)]['hyrje'] = $site->hyrje;
            $table[strtolower($site->filiali)]['dergesa'] = $site->dergesa;
            $table[strtolower($site->filiali)]['kthime'] = $site->kthime;
            $table[strtolower($site->filiali)]['lek'] = $site->lek;
        }


        $branches = DB::select(DB::raw('
            SELECT
              branches.name AS dega,
              branches.id AS dega_id,
              sites.name AS filiali,
              sites.id AS filiali_id,
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
              SUM(IF(hshpikats.HSH=\'SH\',articles.Cmimi,NULL) ) as lek
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
              branches.id HAVING filiali != ""'));


        // $branches_assoc = [];
        foreach ($branches as $branch){
            //$branches_assoc[$branch->dega_id][] = $branch;

            //totalet e filialit
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['shitur'] = $branch->shitje;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['hyrje'] = $branch->hyrje;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['dergesa'] = $branch->dergesa;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['kthime'] = $branch->kthime;
            $table[strtolower($branch->filiali)]['deget'][strtolower($branch->dega)]['lek'] = $branch->lek;
        }

        $users = DB::select(DB::raw('
             SELECT
              users.username,
              offices.postal_code,
              LOWER(offices.slug) as zyra,
              LOWER(branches.slug) AS dega,
              LOWER(sites.slug) AS filiali,
              SUM(
                IF(
                  hshpikats.HSH = \'SH\',
                  articles.Cmimi,
                  0
                )
              ) AS lek,
              COUNT(
                IF(
                  hshpikats.HSH = \'SH\',
                  hshpikats.id,
                  NULL
                )
              ) AS produkte
            FROM
              users
            LEFT JOIN
              hshpikats ON hshpikats.id_user = users.id
            LEFT JOIN
              articles ON hshpikats.artikull_id = articles.id
            LEFT JOIN
              offices ON users.office_id = offices.id
            LEFT JOIN
              branches ON branches.id = offices.branch_id
            LEFT JOIN
              sites ON sites.id = branches.site_id
              WHERE 1=1 
              '.$offices_stmt.'
              '.$date_stmt.'
              And
              Articles.Cmimi = 2940
            GROUP BY
              users.id
              HAVING zyra != ""'));

        foreach ($users as $user){

            //totalet e filialit
            $table[strtolower($user->filiali)]['deget'][strtolower($user->dega)]['zyrat'][strtolower($user->zyra)]['users'][$user->username]['shitur'] = $user->lek;
            $table[strtolower($user->filiali)]['deget'][strtolower($user->dega)]['zyrat'][strtolower($user->zyra)]['users'][$user->username]['produkte'] = $user->produkte;

        }


        Excel::create('Filename', function($excel) use ($table){

            $excel->sheet('Sheetname', function($sheet) use ($table) {

                $sheet->fromArray($table);

            });

        })->export('xls');
    }

    public function getSitesByRole(Request $request){
        $results = [];
        $user = Auth::user();

        $sites = Site::query();

        if($user->hasRole('admin') ||  $user->hasRole('Specialist Shërbimesh në Drejtori') ){
        }

        if($user->hasRole('Kryetar Zyre')){
            return $results;
        }

        if($user->hasRole('Specialist në Degë')){
            return $results;
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                return $results;
            }
            $site = $sites->where('id',$user->site_id);
        }

        $sites = $sites->get();

        $sites->map(function ($site) use (&$results){
            $results['results'][] = [
                'id' => $site->id,
                'text' => $site->name,
            ];
        });

        return $results;
    }

    public function getBranchesByRole(Request $request){
        $results = [];
        $user = Auth::user();

        $branches = Branch::query();

        if($user->hasRole('admin') || $user->hasRole('Specialist Shërbimesh në Drejtori')){
        }

        if($user->hasRole('Kryetar Zyre')){
            return $results;
        }

        if($user->hasRole('Specialist në Degë')){
            if (!$user->branch_id){
                return $results;
            }
            $branches->where('id', $user->branch_id);
        }

        $siteBranches = [];
        if($user->hasRole('Specialist në Filial')){
            if ($user->site_id){
                $siteBranches = Branch::where('site_id', $user->site_id)->get();
                $siteBranches =   $siteBranches->pluck('id')->all();
                $branches->whereIn('id',$siteBranches);
            }
        }

        if($request->input('filiali') != null){
            $siteBranches = Branch::where('site_id', $request->input('filiali'))->get();
            $siteBranches =   $siteBranches->pluck('id')->all();
            $branches->whereIn('id',$siteBranches);
        }


        $branches = $branches->get();

        $branches->map(function ($branch) use (&$results){
            $results['results'][] = [
                'id' => $branch->id,
                'text' => $branch->name,
            ];
        });

        return $results;
    }

    public function getOfficesByRole(Request $request){
        $results = [];

        $user = Auth::user();

        $offices = Office::query();

        if($user->hasRole('admin') ||  $user->hasRole('Specialist Shërbimesh në Drejtori')){
        }

        if($user->hasRole('Kryetar Zyre')){
            if (!$user->office_id){
                return $results;
            }
            $offices->where('id',$user->office_id);
        }

        if($user->hasRole('Specialist në Degë')){
            if (!$user->branch_id){
                return $results;
            }

            $branch_offices = Office::where('branch_id',$user->branch_id)->get();
            $branch_offices = $branch_offices->pluck('id')->all();

            $offices->whereIn('id', $branch_offices);
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                return $results;
            }

            $siteBranches = Branch::where('site_id', $user->site_id)->get();
            $siteBranches =   $siteBranches->pluck('id')->all();

            $offices->whereIn('branch_id', $siteBranches);
        }

        if($request->input('branch') != null) {
            $branch = Branch::where('id', $request->input('branch'))->first();
            $offices->where('branch_id',$branch->id);
        }


        $offices = $offices->orderBy('postal_code')->get();

        $offices->map(function ($office) use (&$results){
            $results['results'][] = [
                'id' => $office->id,
                'text' => $office->name,
            ];
        });

        return $results;
    }

    public function getUsersByRole(Request $request){
        $results = [];

        $user = Auth::user();

        $users = User::query();

        if($user->hasRole('admin') ||  $user->hasRole('Specialist Shërbimesh në Drejtori')){
        }

        if($user->hasRole('Kryetar Zyre')){
            if (!$user->office_id){
                return $results;
            }

            $users->where('office_id',$user->office_id);
        }

        if($user->hasRole('Specialist në Degë')){
            if (!$user->branch_id){
                return $results;
            }

            $branch_offices = Office::where('branch_id',$user->branch_id)->get();
            $branch_offices = $branch_offices->pluck('id')->all();

            $users->whereIn('office_id', $branch_offices);
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                return $results;
            }

            $siteBranches = Branch::where('site_id', $user->site_id)->get();
            $siteBranches =   $siteBranches->pluck('id')->all();
            $branchOffices = Office::whereIn('branch_id', $siteBranches)->get();
            $branchOffices = $branchOffices->pluck('id')->all();

            $users->whereIn('office_id', $branchOffices);
        }

        if($request->input('office') != null) {
            $users->where('office_id', $request->input('office') );
        }

        $users = $users->orderBy('name')->get();

        $users->map(function ($user) use (&$results){
            $results['results'][] = [
                'id' => $user->id,
                'text' => $user->name,
            ];
        });

        return $results;
    }


}