<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowingsTable extends Migration
{
    public function up()
    {
        Schema::create('followings', function (Blueprint $table) {
            // $table->timestamps();
            $table->bigInteger('follower')->unsigned();
            $table->bigInteger('followed')->unsigned()->nullable();
            $table->foreign('follower')->references('id')->on('users');
            $table->foreign('followed')->references('id')->on('users');
            $table->unique(['follower', 'followed']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('followings');
    }
}
