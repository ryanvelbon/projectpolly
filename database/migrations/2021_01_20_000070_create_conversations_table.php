<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_group_chat')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
