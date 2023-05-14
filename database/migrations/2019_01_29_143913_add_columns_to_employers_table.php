<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            $table->string('looking_for_pro')->nullable();
            $table->string('looking_for_gw')->nullable();
            $table->string('looking_for_dm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            $table->dropColumn('looking_for_pro');
            $table->dropColumn('looking_for_gw');
            $table->dropColumn('looking_for_dm');
        });
    }
}
