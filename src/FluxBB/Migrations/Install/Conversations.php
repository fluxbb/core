<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conversations extends Migration
{
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->create();

            $table->increments('id');
            $table->string('title');
            $table->string('category_slug', 100)->nullable()->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('conversations');
    }
}
