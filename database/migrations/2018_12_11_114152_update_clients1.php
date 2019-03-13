<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClients1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function ($table) {
            $table->string('address')->nullable()->default('null')->change();;
            $table->string('tel')->nullable()->default('null')->change();;
            $table->string('qyteti')->nullable()->default('null');
            $table->string('njesia')->nullable()->default('null');

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
