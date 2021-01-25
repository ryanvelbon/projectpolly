<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            // 'is_like' field:  false = dislike and if row does not exist for a given
            // sentence and user, this means that user neither likes nor dislikes sentence
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('sentence_id')->unsigned();
            $table->boolean('is_like');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sentence_id')->references('id')->on('sentences');
            $table->unique(['user_id', 'sentence_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
