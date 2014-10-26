<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Groups extends Migration
{
    /**
     * @var string
     */
    protected $table = 'groups';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->increments('id');
        $table->string('title', 50)->default('');

        $table->integer('parent_group_id')->unsigned()->nullable();
    }
}
