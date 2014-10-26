<?php

if (FluxBB\Core::isInstalled()) {
    Config::set('database.connections.fluxbb', Config::get('fluxbb.database'));
    DB::setDefaultConnection('fluxbb');
}

// Load our validation helpers
include __DIR__.'/helpers/validators.php';
