<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hdmq extends Model
{
   protected $fillable = [ 'HD', 'dt', 'artikull_id', 'qyteti', 'id_pika', 'id_user' ];

   public function article()
   {
       return $this->belongsTo('App\Article');
   }

}
