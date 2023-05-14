<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProfessionalExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_experiences', function (Blueprint $table) {
            $table->boolean('is_present_job')->nullable();
            $table->string('position_level')->nullable();
            $table->text('experience_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_experiences', function (Blueprint $table) {
            $table->dropColumn('is_present_job');
            $table->dropColumn('position_level');
            $table->dropColumn('experience_description');
        });
    }
}
