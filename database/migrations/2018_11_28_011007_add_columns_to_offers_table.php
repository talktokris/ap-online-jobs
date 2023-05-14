<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('preferred_country2')->nullable();
            $table->string('preferred_country3')->nullable();
            $table->string('approvalQuotaAndLevy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('preferred_country2');
            $table->dropColumn('preferred_country3');
            $table->dropColumn('approvalQuotaAndLevy');
        });
    }
}
