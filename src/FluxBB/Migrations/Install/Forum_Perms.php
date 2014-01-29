<?php

namespace FluxBB\Migrations\Install;

use Schema;

class Forum_Perms
{

    public function up()
    {
        Schema::table('forum_perms', function($table) {
            $table->create();

            $table->integer('group_id')->unsigned();
            $table->integer('forum_id')->unsigned();
            $table->boolean('read_forum')->default(true);
            $table->boolean('post_replies')->default(true);
            $table->boolean('post_topics')->default(true);

            $table->primary(array('group_id', 'forum_id'));
        });
    }

    public function down()
    {
        Schema::drop('forum_perms');
    }

}
