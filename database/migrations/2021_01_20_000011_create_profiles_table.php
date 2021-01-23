<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('native_lang')->unsigned()->nullable();
            $table->bigInteger('nationality')->unsigned()->nullable();
            $table->date('dob')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('bio', 300)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('native_lang')->references('id')->on('languages');
            $table->foreign('nationality')->references('id')->on('countries');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
