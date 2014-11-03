<?php

namespace FluxBB\Validation;

use FluxBB\Core\Validator;
use FluxBB\Server\Request;

class OptionsValidator extends Validator
{
    /**
     * Get the rules to validate against.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'board_title'           => 'max:50',
            'board_desc'            => 'max:120',
            'default_timezone'      => '',
            'default_dst'           => 'integer|in:0,1',
            'time_format'           => '',
            'date_format'           => '',
            'timeout_visit'         => 'integer|between:0,9999',
            'timeout_online'        => 'integer|between:0,9999',
            'make_links'            => 'integer|in:0,1',
            'disp_topics_default'   => 'integer|between:0,100',
            'disp_posts_default'    => 'integer|between:0,100',
            'users_online'          => 'integer|in:0,1',
            'signatures'            => 'integer|in:0,1',
            'show_dot'              => 'integer|in:0,1',
            'topic_views'           => 'integer|in:0,1',
            'regs_allow'            => 'integer|in:0,1',
            'regs_verify'           => 'integer|in:0,1',
            'regs_report'           => 'integer|in:0,1',
            'rules'                 => 'integer|in:0,1',
            'rules_message'         => 'alpha_num|max:2000',
            'default_email_setting' => 'integer|in:0,1,2',
            'default_lang'          => 'alpha_num',
            'default_style'         => 'alpha_num',
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
        $options = $request->getParameters();

        $this->ensureAllInRules($options)
             ->ensureValid($options);
    }
}
