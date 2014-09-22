<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;

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
     * Make sure the given attributes are valid for a user.
     *
     * @param array $user
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    public function validate(array $user)
    {
        $this->ensureValid($user);
    }
}
