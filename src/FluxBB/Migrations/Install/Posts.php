<?php

namespace FluxBB\Migrations\Install;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->create();

            $table->increments('id');
            $table->string('poster', 200)->default('');
            $table->integer('poster_id')->unsigned()->default(1);
            $table->string('poster_ip', 39)->nullable();
            $table->text('message')->nullable();
            $table->boolean('hide_smilies')->default(false);
            $table->integer('posted')->unsigned()->default(0);
            $table->integer('edited')->unsigned()->nullable();
            $table->string('edited_by', 200)->nullable();
            $table->integer('conversation_id')->unsigned();

            $table->index('conversation_id');
            $table->index(['poster_id', 'conversation_id']);
        });
    }

    public function down()
    {
        Schema::drop('posts');
    }
}
