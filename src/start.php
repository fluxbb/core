<?php

if (FluxBB\Core::isInstalled()) {
    Config::set('database.connections.fluxbb', Config::get('fluxbb.database'));
    DB::setDefaultConnection('fluxbb');
}

// Load our helpers (composers, macros, validators etc.)
include __DIR__.'/helpers.php';
