<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Forums extends Migration
{
    /**
     * @var string
     */
    protected $table = 'forums';


    protected function create(Blueprint $table)
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
    }
}
