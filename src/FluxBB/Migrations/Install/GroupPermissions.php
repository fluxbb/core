<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class GroupPermissions extends Migration
{
    public function up()
    {
        Schema::table('group_permissions', function($table) {
            $table->create();

            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('name', 50);
            $table->boolean('value');
        });
    }

    public function down()
    {
        Schema::drop('group_permissions');
    }
}
