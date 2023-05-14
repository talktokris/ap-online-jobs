<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('resume_file')->nullable();
            $table->string('current_designation')->nullable();
            $table->string('current_company')->nullable();
            $table->string('annual_salary')->nullable();
            $table->date('working_from')->nullable();
            $table->date('working_to')->nullable();
            $table->string('highest_qualification')->nullable();
            $table->string('subject')->nullable();
            $table->string('specialization')->nullable();
            $table->string('university')->nullable();
            $table->date('passing_year')->nullable();
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
        Schema::dropIfExists('professional_profiles');
    }
}
