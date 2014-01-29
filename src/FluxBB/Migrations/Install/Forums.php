<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Forums extends Migration
{

    public function up()
    {
        Schema::table('forums', function($table)
        {
            $table->create();

            $table->increments('id');
            $table->string('forum_name', 80);
            $table->text('forum_desc')->nullable();
            $table->string('redirect_url', 100)->nullable();
            $table->integer('num_topics')->unsigned()->default(0);
            $table->integer('num_posts')->unsigned()->default(0);
            $table->integer('last_post')->unsigned()->nullable();
            $table->integer('last_post_id')->unsigned()->nullable();
            $table->string('last_poster', 200)->nullable();
            $table->integer('sort_by')->unsigned()->default(0);
            $table->integer('disp_position')->default(0);
            $table->integer('cat_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('forums');
    }

}