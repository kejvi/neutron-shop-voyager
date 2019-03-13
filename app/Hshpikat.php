<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hshpikat extends Model
{
    protected $fillable = [ 'HSH', 'dt', 'artikull_id', 'qyteti', 'id_pika', 'id_user' ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

}
