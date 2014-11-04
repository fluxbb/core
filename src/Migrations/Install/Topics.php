<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Topics extends Migration
{
    /**
     * @var string
     */
    protected $table = 'topics';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->increments('id');
        $table->string('poster', 200)->default('');
        $table->string('subject', 255)->default('');
        $table->integer('posted')->unsigned()->default(0);
        $table->integer('first_post_id')->unsigned()->default(0);
        $table->integer('last_post')->unsigned()->default(0);
        $table->integer('last_post_id')->unsigned()->default(0);
        $table->string('last_poster', 200)->nullable();
        $table->integer('num_views')->unsigned()->default(0);
        $table->integer('num_replies')->unsigned()->default(0);
        $table->boolean('closed')->default(false);
        $table->boolean('sticky')->default(false);
        $table->integer('moved_to')->unsigned()->nullable();
        $table->integer('forum_id')->unsigned()->default(0);

        $table->index('forum_id');
        $table->index('moved_to');
        $table->index('last_post');
        $table->index('first_post_id');
    }
}
