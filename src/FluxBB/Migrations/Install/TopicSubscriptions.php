<?php

namespace FluxBB\Migrations\Install;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class TopicSubscriptions extends Migration
{
    public function up()
    {
        Schema::table('topic_subscriptions', function ($table) {
            $table->create();

            $table->integer('user_id')->unsigned();
            $table->integer('topic_id')->unsigned();

            $table->primary(array('user_id', 'topic_id'));
        });
    }

    public function down()
    {
        Schema::drop('topic_subscriptions');
    }
}
