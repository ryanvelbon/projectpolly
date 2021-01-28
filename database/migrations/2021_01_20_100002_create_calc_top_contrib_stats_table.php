<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcTopContribStatsTable extends Migration
{
    public function up()
    {
        Schema::create('calc_top_contrib_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->string('timeframe');
            $table->integer('sentence_count')->unsigned();
            $table->tinyinteger('position')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calc_top_contrib_stats');
    }
}
