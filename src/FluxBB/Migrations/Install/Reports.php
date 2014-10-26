<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Reports extends Migration
{
    /**
     * @var string
     */
    protected $table = 'reports';


    protected function create(Blueprint $table)
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
    }
}
