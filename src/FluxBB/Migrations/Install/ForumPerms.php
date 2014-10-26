<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ForumPerms extends Migration
{
    /**
     * @var string
     */
    protected $table = 'forum_perms';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->integer('group_id')->unsigned();
        $table->integer('forum_id')->unsigned();
        $table->boolean('read_forum')->default(true);
        $table->boolean('post_replies')->default(true);
        $table->boolean('post_topics')->default(true);

        $table->primary(array('group_id', 'forum_id'));
    }
}
