<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('job_position')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('highest_education')->nullable();
            $table->string('preferred_language')->nullable();
            $table->string('reading')->nullable();
            $table->string('written')->nullable();
            $table->string('job_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('job_position');
            $table->dropColumn('gender');
            $table->dropColumn('marital_status');
            $table->dropColumn('highest_education');
            $table->dropColumn('preferred_language');
            $table->dropColumn('reading');
            $table->dropColumn('written');
            $table->dropColumn('job_location');
        });
    }
}
