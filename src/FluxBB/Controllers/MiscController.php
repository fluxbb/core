<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Config;

class MiscController extends BaseController
{

    public function get_rules()
    {
        // TODO: Move to filter and use roles / permissions
        // TODO2: Also apply this filter (current OR this)
        // ($pun_user['is_guest'] && $pun_user['g_read_board'] == '0' && $pun_config['o_regs_allow'] == '0')
        if (Config::disabled('o_rules')) {
            return \Response::error('404');
        }

        return \View::make('misc.rules')
            ->with('rules', Config::get('o_rules_message'));
    }

}
