<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TopicSubscriptions extends Migration
{
    /**
     * @var string
     */
    protected $table = 'topic_subscriptions';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->integer('user_id')->unsigned();
        $table->integer('topic_id')->unsigned();

        $table->primary(array('user_id', 'topic_id'));
    }
}
