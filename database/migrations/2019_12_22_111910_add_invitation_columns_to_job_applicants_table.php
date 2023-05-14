<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvitationColumnsToJobApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applicants', function (Blueprint $table) {
            $table->boolean('applied_by_jobseeker')->nullable();
            $table->boolean('invited_by_employer')->nullable();
            $table->boolean('suggested_by_admin')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('interview_date')->nullable();
            $table->date('hiring_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_applicants', function (Blueprint $table) {
            //
        });
    }
}
