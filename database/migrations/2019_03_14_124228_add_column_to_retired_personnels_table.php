<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToRetiredPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retired_personnels', function (Blueprint $table) {
            $table->string('resume')->nullable();
            $table->string('health_statement')->nullable();
            $table->string('additional_health_statement')->nullable();
            $table->string('fit_to_work')->nullable();
            $table->string('have_blood_pressure')->nullable();
            $table->string('have_diabetes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retired_personnels', function (Blueprint $table) {
            $table->dropColumn('resume');
            $table->dropColumn('health_statement');
            $table->dropColumn('additional_health_statement');
            $table->dropColumn('fit_to_work');
            $table->dropColumn('have_blood_pressure');
            $table->dropColumn('have_diabetes');
        });
    }
}
