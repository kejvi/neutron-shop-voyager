<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hdmq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdmqs', function (Blueprint $table){
            $table->increments('id');
            $table->string('HD');
            $table->datetime('dt');
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
        Schema::drop('hdmqs');
    }
}
