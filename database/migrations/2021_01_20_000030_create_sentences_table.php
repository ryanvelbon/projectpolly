<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentencesTable extends Migration
{
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('body', 255);
            $table->bigInteger('lang_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sentences');
    }
}
