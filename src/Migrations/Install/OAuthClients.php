<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class OAuthClients extends Migration
{
    /**
     * @var string
     */
    protected $table = 'oauth_clients';
    protected function create(Blueprint $table)
    {
        $table->create();
        $table->string('client_id', 80);
        $table->string('client_secret', 80);
        $table->string('redirect_uri', 2000);
        $table->string('grant_types', 80);
        $table->string('scope', 100);
        $table->string('user_id', 80);
        $table->timestamps();
     }
}
