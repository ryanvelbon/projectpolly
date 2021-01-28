<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('sentence_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sentence_id')->references('id')->on('sentences');
            $table->unique(['user_id', 'sentence_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
