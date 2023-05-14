<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employer_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('hiring_package', 20)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('demand_letter_no', 50)->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expexted_date')->nullable();
            $table->string('demand_qty', 20)->nullable();
            $table->unsignedInteger('preferred_country')->nullable();
            $table->text('comments')->nullable();
            $table->string('demand_file', 200)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('assigned_agent')->nullable();
            $table->date('proposed_date')->nullable();
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('users');
            // $table->foreign('preferred_country')->references('id')->on('countries');
            // $table->foreign('assigned_agent')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
