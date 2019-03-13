<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHshpikats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hshpikats', function ($table) {
            $table->string('id_pika_ardhur')->nullable()->default('null');
            $table->string('id_user_transfer')->nullable()->default('null');
            $table->string('data_transferimit')->nullable()->default('null');
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
