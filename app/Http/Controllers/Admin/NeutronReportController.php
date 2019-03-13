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
use Illuminate\Support\Facades\Input;

class NeutronReportController extends  VoyagerBaseController {

    public function index(Request $request)
    {

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

//        dd($dataType);
        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $view = 'voyager::bread.browse';

        $user = Auth::user();

        $monthFirstDate = null;
        $monthEndDate = null;

        //Check the date range
        if($request->input('daterange')){
            $fdate = explode(' - ' , $request->input('daterange'))[0];
            $edate = explode(' - ' , $request->input('daterange'))[1];

            $monthFirstDate = $fdate;
            $monthEndDate = $edate;
        }

        $offices = Office::query();

        if($user->hasRole('admin')){
        }

        if($user->hasRole('Kryetar Zyre')){
            $offices->where('id' , '=' ,  $user->office_id );
        }

        if($user->hasRole('Specialist në Degë')){

            if (!$user->branch_id){
                abort(403);
            }
            $branch = Branch::find($user->branch_id);
            $offices->where('branch_id' , '=' ,  $branch->id );
        }

        if($user->hasRole('Specialist në Filial')){
            if (!$user->site_id){
                abort(403);
            }
            $site = Site::find($user->site_id);
            $branches = Branch::where('site_id', $site->id)->get();
            $branchIds = $branches->pluck('id')->all();
            $offices->whereIn('branch_id' , $branchIds );

        }


        if ($request->input('site')){
            $site = Site::where('slug' , $request->input('site'))->first();
            $branches = Branch::where('site_id', $site->id)->get();
            $branchIds = $branches->pluck('id')->all();
            $offices->whereIn('branch_id' , $branchIds );
        }

        if ($request->input('branch')){
            $branch = Branch::where('slug', $request->input('branch') )->first();
            $offices->where('branch_id' , $branch->id );
        }

        $offices = $offices->orderBy('postal_code')->paginate(50);
        $offices = $offices->appends(Input::except('page'));


        $sites = Site::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        $selectedSite = $request->input('site');
        $selectedBranch = $request->input('branch');

        if (view()->exists("voyager::$slug.browse")){
            $view = "voyager::$slug.browse";
        }

        return Voyager::view( $view , compact(
            'dataType',
            'dataTypeContent',
            'offices',
            'monthFirstDate',
            'monthEndDate',
            'sites',
            'branches',
            'selectedBranch',
            'selectedSite'
        ));
    }
}