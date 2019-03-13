<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table){
            $table->increments('id');
            $table->integer('branch_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('postal_code');
            $table->string('hall');
            $table->timestamps();
        });

        Schema::create('office_branch', function (Blueprint $table){
            $table->integer('office_id');
            $table->integer('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offices');
    }
}
