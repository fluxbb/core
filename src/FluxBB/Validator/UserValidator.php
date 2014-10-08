<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;
use FluxBB\Server\Request;

class UserValidator extends Validator
{
    /**
     * Get the rules to validate against.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'user'      => 'required|between:2,25|username_not_guest|no_ip|username_not_reserved|no_bbcode|unique:users,username|username_not_banned',
            'password'  => 'required|min:4|confirmed',
            'email'     => 'required|email|unique:users,email',
        ];
    }

    /**
     * Validate the given request.
     *
     * Should throw an exception if validation fails.
     *
     * @param \FluxBB\Server\Request $request
     * @return void
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    public function validate(Request $request)
    {
        $this->ensureValid($request->getParameters());
    }
}
