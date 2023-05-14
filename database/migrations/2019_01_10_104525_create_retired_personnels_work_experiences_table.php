<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetiredPersonnelsWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retired_personnels_work_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('work_description')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('nature_of_company_business')->nullable();
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
        Schema::dropIfExists('retired_personnels_work_experiences');
    }
}
