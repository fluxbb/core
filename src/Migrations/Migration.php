<?php

namespace FluxBB\Migrations;

use Illuminate\Database\Migrations\Migration as LaravelMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

abstract class Migration extends LaravelMigration
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * @var string
     */
    protected $table = '';


    public function __construct(Builder $builder)
    {
        $this->schema = $builder;
    }

    public function up()
    {
        $this->schema->table($this->table, function ($table) {
            $this->create($table);
        });
    }

    abstract protected function create(Blueprint $table);

    public function down()
    {
        $this->schema->drop($this->table);
    }
}
