<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Office extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','postal_code','name','slug'
    ];

    public function getSentArticles($fdate = null , $edate = null)
    {

        $dergesa = DB::table('hshpikats')
            ->where('id_pika','=',$this->id)
            ->where(function ($query) {
                $query->where('hshpikats.HSH','=','SH')
                    ->orWhere('hshpikats.HSH','=','H');
            });

        if ($fdate !== null && $edate !== null){
            $fdate =  Carbon::createFromFormat('d/m/Y', $fdate)->format('Y-m-d H:i:s');
            $edate =  Carbon::createFromFormat('d/m/Y', $edate)->format('Y-m-d H:i:s');

            $dergesa->where('dt', '>=' , $fdate)
                ->where('dt', '<=' , $edate);
        }

        $dergesa = $dergesa->count();

        return $dergesa;
    }

    public function getTotalSold($fdate = null , $edate = null)
    {
        $totalShitur = DB::table('hshpikats')
            ->where('HSH','SH')
            ->where('id_pika',$this->id);

        $totalKthyer = DB::table('hshpikats')
            ->where('HSH','K')
            ->where('id_pika',$this->id);

            if ($fdate !== null && $edate !== null){
                $fdate =  Carbon::createFromFormat('d/m/Y', $fdate)->format('Y-m-d H:i:s');
                $edate =  Carbon::createFromFormat('d/m/Y', $edate)->format('Y-m-d H:i:s');

                $totalShitur->where('dt_sh', '>=' , $fdate)
                    ->where('dt_sh', '<=' , $edate);


                $totalKthyer->where('dt_sh', '>=' , $fdate)
                    ->where('dt_sh', '<=' , $edate);

            }

           $totalShitur =  $totalShitur->count();
           $totalKthyer =  $totalKthyer->count();

        return $totalShitur - $totalKthyer;
    }

    public function getCurrentState($fdate = null , $edate = null)
    {
        $gjendja = DB::table('hshpikats')
            ->where('HSH','H')
            ->where('id_pika',$this->id);

            if ($fdate !== null && $edate !== null){
                $fdate =  Carbon::createFromFormat('d/m/Y', $fdate)->format('Y-m-d H:i:s');
                $edate =  Carbon::createFromFormat('d/m/Y', $edate)->format('Y-m-d H:i:s');

                $gjendja->where('dt', '>=' , $fdate)
                    ->where('dt', '<=' , $edate);
            }

         $gjendja=  $gjendja->count();

        return $gjendja;
    }



}
