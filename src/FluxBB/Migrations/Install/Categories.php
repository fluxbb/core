<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Categories extends Migration
{
    /**
     * @var string
     */
    protected $table = 'categories';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->string('slug', 100)->primary();
        $table->string('name');
        $table->integer('position')->default(0);
        $table->boolean('conversations_enabled')->default(true);

        $table->timestamps();
    }
}
