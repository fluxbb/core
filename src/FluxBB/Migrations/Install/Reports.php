<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Reports extends Migration
{

    public function up()
    {
        Schema::table('reports', function($table)
        {
            $table->create();

            $table->increments('id');
            $table->integer('post_id')->unsigned()->default(0);
            $table->integer('topic_id')->unsigned()->default(0);
            $table->integer('forum_id')->unsigned()->default(0);
            $table->integer('reported_by')->unsigned()->default(0);
            $table->integer('created')->unsigned()->default(0);
            $table->text('message')->nullable();
            $table->integer('zapped')->unsigned()->nullable();
            $table->integer('zapped_by')->unsigned()->nullable();
            
            $table->index('zapped');
        });
    }

    public function down()
    {
        Schema::drop('reports');
    }

}