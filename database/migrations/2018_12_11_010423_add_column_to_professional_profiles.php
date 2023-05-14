<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToProfessionalProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_profiles', function (Blueprint $table) {
            $table->string('resume_headline', 500)->nullable();
            $table->text('skills')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('expected_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_profiles', function (Blueprint $table) {
            $table->dropColumn('resume_headline');
            $table->dropColumn('skills');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('current_salary');
            $table->dropColumn('expected_salary');
        });
    }
}
