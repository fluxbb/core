<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Conversations extends Migration
{
    /**
     * @var string
     */
    protected $table = 'conversations';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->increments('id');
        $table->string('category_slug', 100)->nullable()->index();
        $table->string('title');
        $table->string('poster', 200)->default('');
        $table->integer('posted')->unsigned()->default(0);
        $table->integer('first_post_id')->unsigned()->default(0);
        $table->integer('last_post')->unsigned()->default(0);
        $table->integer('last_post_id')->unsigned()->default(0);
        $table->string('last_poster', 200)->nullable();
        $table->integer('num_views')->unsigned()->default(0);
        $table->integer('num_replies')->unsigned()->default(0);

        $table->timestamps();
    }
}
