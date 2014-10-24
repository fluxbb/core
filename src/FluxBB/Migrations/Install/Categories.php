<?php

namespace FluxBB\Migrations\Install;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->create();

            $table->string('slug', 100)->primary();
            $table->string('name');
            $table->integer('position')->default(0);
            $table->boolean('conversations_enabled')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('categories');
    }
}
