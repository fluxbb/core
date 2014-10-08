<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;
use FluxBB\Models\Post;
use FluxBB\Server\Request;

class PostValidator extends Validator
{
    /**
     * Get the rules to validate against.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'message' => 'required',
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
