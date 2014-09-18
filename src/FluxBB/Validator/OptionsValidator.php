<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;

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
            'board_title'           => 'alpha_num|max:50',
            'board_desc'            => 'alpha_num|max:120',
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
        ];
    }

    /**
     * Make sure the given options are valid.
     *
     * @param array $options
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    public function validate(array $options)
    {
        $this->ensureAllInRules($options);
        $this->ensureValid($options);
    }
}
