<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class OAuthRefreshTokens extends Migration
{
    /**
     * @var string
     */
    protected $table = 'oauth_refresh_tokens';
    protected function create(Blueprint $table)
    {
        $table->create();
        $table->string('refresh_token', 40);
        $table->string('client_id', 80);
        $table->string('user_id', 255);
        $table->timestamp('expires');
        $table->string('scope', 2000);
     }
}

