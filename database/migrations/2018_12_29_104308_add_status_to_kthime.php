<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToKthime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kthime_dekoderi', function (Blueprint $table) {
            $table->enum('status', ['ne_pritje', 'aprovuar', 'refuzuar','auto_refuzuar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kthime', function (Blueprint $table) {

        });
    }
}
