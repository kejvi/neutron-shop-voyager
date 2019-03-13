<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $fillable = [ 'HSH', 'dt', 'artikull_id', 'qyteti', 'id_pika', 'id_user' ];

    protected $table = 'hdmqs';

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
