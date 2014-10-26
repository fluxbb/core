<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class GroupPermissions extends Migration
{
    /**
     * @var string
     */
    protected $table = 'group_permissions';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->increments('id');
        $table->integer('group_id')->unsigned();
        $table->string('name', 50);
        $table->boolean('value');
    }
}
