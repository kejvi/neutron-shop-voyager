<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hshpikat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hshpikats', function (Blueprint $table){
            $table->increments('id');
            $table->string('HSH');
            $table->datetime('dt');
            $table->datetime('dt_sh')->nullable();
            $table->integer('artikull_id');
            $table->string('qyteti');
            $table->integer('id_pika');
            $table->integer('id_user');
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
        Schema::drop('hshpikats');
    }
}
