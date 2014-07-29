<?php

Route::filter('fluxbb_is_installed', function () {
    if (!FluxBB\Core::isInstalled()) {
        return View::make('fluxbb::not_installed')
            ->with('has_installer', false);
    }
});
