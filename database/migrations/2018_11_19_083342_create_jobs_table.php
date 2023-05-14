<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('positions_name')->nullable();
            $table->text('vacancies_description')->nullable();
            $table->text('scope_of_duties')->nullable();
            $table->text('skills')->nullable();
            $table->string('related_experience_year')->nullable();
            $table->string('related_experience_month')->nullable();
            $table->string('job_vacancies_type')->nullable();
            $table->string('salary_offer_currency')->nullable();
            $table->string('salary_offer')->nullable();
            $table->string('salary_offer_period')->nullable();
            //Job Location
            $table->string('postcode')->nullable();
            $table->string('district')->nullable();
            $table->string('town')->nullable();
            $table->string('state')->nullable();
            
            $table->string('total_number_of_vacancies')->nullable();
            $table->date('closing_date')->nullable();
            $table->string('working_hours')->nullable();

            //Contact person
            $table->string('person_in_charge')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('handphone_number')->nullable();
            $table->string('email')->nullable();

            //Candidate details
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('race')->nullable();
            $table->string('age_eligibillity')->nullable();
            $table->text('other_requirements')->nullable();
            $table->text('facilities')->nullable();
            

            //Academic
            $table->text('language')->nullable();
            $table->string('minimum_academic_qualification')->nullable();
            $table->string('academic_field')->nullable();
            $table->text('driving_license')->nullable();
            $table->text('other_skills')->nullable();

            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('jobs');
    }
}
