<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastActiveTimeToCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cameras', function (Blueprint $table) {
            //
            $table->timestamp("last_active_time")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cameras', function (Blueprint $table) {
            //
            $table->dropColumn("last_active_time");
        });
    }
}
