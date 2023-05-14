<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWorkDescriptionColumnOnRetiedPersonnelExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retired_personnels_work_experiences', function (Blueprint $table) {
            $table->longtext('work_description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retired_personnels_work_experiences', function (Blueprint $table) {
            //
        });
    }
}
