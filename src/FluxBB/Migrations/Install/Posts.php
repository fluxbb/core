<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{

    public function up()
    {
        Schema::table('posts', function($table) {
            $table->create();

            $table->increments('id');
            $table->string('poster', 200)->default('');
            $table->integer('poster_id')->unsigned()->default(1);
            $table->string('poster_ip', 39)->nullable();
            $table->string('poster_email', 80)->nullable();
            $table->text('message')->nullable();
            $table->boolean('hide_smilies')->default(false);
            $table->integer('posted')->unsigned()->default(0);
            $table->integer('edited')->unsigned()->nullable();
            $table->string('edited_by', 200)->nullable();
            $table->integer('topic_id')->unsigned();

            $table->index('topic_id');
            $table->index(array('poster_id', 'topic_id'));
        });
    }

    public function down()
    {
        Schema::drop('posts');
    }

}
