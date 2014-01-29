<?php

namespace FluxBB\Migrations\Install;

use Schema;

class Forum_Subscriptions
{

    public function up()
    {
        Schema::table('forum_subscriptions', function($table)
        {
            $table->create();

            $table->integer('user_id')->unsigned();
            $table->integer('forum_id')->unsigned();

            $table->primary(array('user_id', 'forum_id'));
        });
    }

    public function down()
    {
        Schema::drop('forum_subscriptions');
    }

}
