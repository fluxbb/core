<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ForumSubscriptions extends Migration
{
    /**
     * @var string
     */
    protected $table = 'forum_subscriptions';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->integer('user_id')->unsigned();
        $table->integer('forum_id')->unsigned();

        $table->primary(array('user_id', 'forum_id'));
    }
}
