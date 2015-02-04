<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class OAuthJwt extends Migration
{
    /**
     * @var string
     */
    protected $table = 'oauth_jwt';
    protected function create(Blueprint $table)
    {
        $table->create();
        $table->string('client_id', 80);
        $table->string('subject', 80);
        $table->string('public_key', 2000);
    }
}

