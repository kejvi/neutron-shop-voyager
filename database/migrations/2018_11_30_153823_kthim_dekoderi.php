<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KthimDekoderi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kthime_dekoderi', function (Blueprint $table){
            $table->increments('id');
            $table->string('postal_code');
            $table->string('office_name');
            $table->string('user_id');
            $table->string('description');
            $table->string('serial_number');
            $table->string('user_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
