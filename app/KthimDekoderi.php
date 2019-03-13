<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KthimDekoderi extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postal_code', 'user_id', 'description', 'serial_number','office_name', 'user_name'
    ];
    //
    protected $table = 'kthime_dekoderi';
}
