<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetiredPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retired_personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            //Personal Details
            $table->string('name')->nullable();
            $table->string('nric')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('country')->nullable();
            $table->string('government_employee')->nullable();
            //Education & Experiennce
            $table->string('highest_academic_qualification')->nullable();
            $table->string('specialization')->nullable();

            $table->string('full_time')->nullable();
            $table->string('describe_working_hours')->nullable();


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
        Schema::dropIfExists('retired_personnels');
    }
}
