<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class OAuthScopes extends Migration
{
    /**
     * @var string
     */
    protected $table = 'oauth_scopes';
    protected function create(Blueprint $table)
    {
        $table->create();
        $table->string('scope');
        $table->boolean('is_default');
     }
}

