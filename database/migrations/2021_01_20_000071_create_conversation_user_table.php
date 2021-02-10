<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationUserTable extends Migration
{

    /*
     *   Pivot table
     *   The 'joined' and 'is_admin' fields are only necessary for group conversations.
     *   There is no PK
     *   PENDING: Make a composite PK (conversation_id, user_id)
     */



    public function up()
    {
        Schema::create('conversation_user', function (Blueprint $table) {

            $table->bigInteger('conversation_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversations');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['conversation_id', 'user_id']);

            // the following fields are only necessary for group chats
            $table->dateTime('joined')->nullable();
            $table->boolean('is_admin')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversation_user');
    }
}
