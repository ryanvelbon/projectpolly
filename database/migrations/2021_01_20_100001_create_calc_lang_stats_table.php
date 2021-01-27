<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcLangStatsTable extends Migration
{
    public function up()
    {
        Schema::create('calc_lang_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('lang_id')->unsigned()->unique();
            $table->integer('sentence_count')->unsigned();
            $table->integer('native_speaker_count')->unsigned();
            $table->integer('learner_count')->unsigned()->nullable(); // temporarily nullable
            $table->bigInteger('top_contributor_id')->unsigned();

            $table->foreign('lang_id')->references('id')->on('languages');
            $table->foreign('top_contributor_id')->references('id')->on('users');

        });
    }

    public function down()
    {
        Schema::dropIfExists('calc_lang_stats');
    }
}
