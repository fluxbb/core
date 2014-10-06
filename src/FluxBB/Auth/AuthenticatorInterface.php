<?php

namespace FluxBB\Auth;

interface AuthenticatorInterface
{
    public function login(array $credentials, $remember = false);

    public function logout();
} 
