<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Groups extends Migration
{
    public function up()
    {
        Schema::table('groups', function ($table) {
            $table->create();

            $table->increments('id');
            $table->string('title', 50)->default('');

            $table->integer('parent_group_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::drop('groups');
    }
}
