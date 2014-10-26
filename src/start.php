<?php

if (FluxBB\Core::isInstalled()) {
    FluxBB\Core::make('config')->set('database.connections.fluxbb', FluxBB\Core::make('config')->get('fluxbb.database'));
    FluxBB\Core::make('db')->setDefaultConnection('fluxbb');
}

// Load our validation helpers
include __DIR__.'/helpers/validators.php';
