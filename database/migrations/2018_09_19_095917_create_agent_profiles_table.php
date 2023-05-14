<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('agent_code')->nullable();
            $table->string('agency_registered_name')->nullable();
            $table->string('agency_address')->nullable();
            $table->string('agency_city')->nullable();
            $table->string('agency_country')->nullable();
            $table->string('agency_phone')->nullable();
            $table->string('agency_fax')->nullable();
            $table->string('agency_email')->nullable();
            $table->string('license_no')->nullable();
            $table->string('license_issue_date')->nullable();
            $table->string('license_expire_date')->nullable();
            $table->string('license_file')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_file')->nullable();
            $table->string('nic')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
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
        Schema::dropIfExists('agent_profiles');
    }
}
