<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('id_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->integer('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('children')->nullable();
            $table->string('siblings')->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->integer('city')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('religion')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('image')->nullable();
             /*Emergency Contact*/
             $table->string('emergency_contact_name')->nullable();
             $table->string('emergency_contact_relationship')->nullable();
             $table->string('emergency_contact_phone')->nullable();
             $table->string('emergency_contact_address')->nullable();
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
        Schema::dropIfExists('maids');
    }
}
