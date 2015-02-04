<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class OAuthAuthorizationCodes extends Migration
{
    /**
     * @var string
     */
    protected $table = 'oauth_authorization_codes';
    protected function create(Blueprint $table)
    {
        $table->create();
        $table->string('authorization_code', 40);
        $table->string('client_id', 80);
        $table->string('user_id', 255)
        $table->string('redirect_uri', 2000);
        $table->timestamp('expires');
        $table->string('scope', 2000);
     }
}

