<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

use fluxbb\CLI\Task,
	fluxbb\Models;

class FluxBB_Install_Task extends Task
{
	
	public function run($arguments = array())
	{
		$this->structure();

		$this->seed();
	}

	public function structure()
	{
		foreach (new FilesystemIterator($this->path()) as $file)
		{
			$migration = basename($file->getFileName(), '.php');

			$this->log('Install '.$migration.'...');

			$class = 'FluxBB_Install_'.Str::classify($migration);
			include_once $file;

			$instance = new $class;
			$instance->up();
		}
	}

	public function seed($arguments = array())
	{
		$this->seed_groups();

		$this->seed_users();

		$this->seed_config();

		$this->seed_content();
	}

	protected function seed_groups()
	{
		// TODO: Can we get rid of these hard-coded IDs?
		
		// Insert the four preset groups
		Group::create(array(
			'g_id'						=> 1,
			'g_title'					=> __('fluxbb_installer::seed_data.administrators'),
			'g_user_title'				=> __('fluxbb_installer::seed_data.administrator'),
			'g_promote_min_posts'		=> 0,
			'g_promote_next_group'		=> 0,
			'g_moderator'				=> 0,
			'g_mod_edit_users'			=> 0,
			'g_mod_rename_users'		=> 0,
			'g_mod_change_passwords'	=> 0,
			'g_mod_ban_users'			=> 0,
			'g_read_board'				=> 1,
			'g_view_users'				=> 1,
			'g_post_replies'			=> 1,
			'g_post_topics'				=> 1,
			'g_edit_posts'				=> 1,
			'g_delete_posts'			=> 1,
			'g_delete_topics'			=> 1,
			'g_post_links'				=> 1,
			'g_set_title'				=> 1,
			'g_search'					=> 1,
			'g_search_users'			=> 1,
			'g_send_email'				=> 1,
			'g_post_flood'				=> 0,
			'g_search_flood'			=> 0,
			'g_email_flood'				=> 0,
			'g_report_flood'			=> 0,
		));

		Group::create(array(
			'g_id'						=> 2,
			'g_title'					=> __('fluxbb_installer::seed_data.moderators'),
			'g_user_title'				=> __('fluxbb_installer::seed_data.moderator'),
			'g_promote_min_posts'		=> 0,
			'g_promote_next_group'		=> 0,
			'g_moderator'				=> 1,
			'g_mod_edit_users'			=> 1,
			'g_mod_rename_users'		=> 1,
			'g_mod_change_passwords'	=> 1,
			'g_mod_ban_users'			=> 1,
			'g_read_board'				=> 1,
			'g_view_users'				=> 1,
			'g_post_replies'			=> 1,
			'g_post_topics'				=> 1,
			'g_edit_posts'				=> 1,
			'g_delete_posts'			=> 1,
			'g_delete_topics'			=> 1,
			'g_post_links'				=> 1,
			'g_set_title'				=> 1,
			'g_search'					=> 1,
			'g_search_users'			=> 1,
			'g_send_email'				=> 1,
			'g_post_flood'				=> 0,
			'g_search_flood'			=> 0,
			'g_email_flood'				=> 0,
			'g_report_flood'			=> 0,
		));

		Group::create(array(
			'g_id'						=> 3,
			'g_title'					=> __('fluxbb_installer::seed_data.guests'),
			'g_user_title'				=> null,
			'g_promote_min_posts'		=> 0,
			'g_promote_next_group'		=> 0,
			'g_moderator'				=> 0,
			'g_mod_edit_users'			=> 0,
			'g_mod_rename_users'		=> 0,
			'g_mod_change_passwords'	=> 0,
			'g_mod_ban_users'			=> 0,
			'g_read_board'				=> 1,
			'g_view_users'				=> 1,
			'g_post_replies'			=> 0,
			'g_post_topics'				=> 0,
			'g_edit_posts'				=> 0,
			'g_delete_posts'			=> 0,
			'g_delete_topics'			=> 0,
			'g_post_links'				=> 0,
			'g_set_title'				=> 0,
			'g_search'					=> 1,
			'g_search_users'			=> 1,
			'g_send_email'				=> 0,
			'g_post_flood'				=> 60,
			'g_search_flood'			=> 30,
			'g_email_flood'				=> 0,
			'g_report_flood'			=> 0,
		));

		Group::create(array(
			'g_id'						=> 4,
			'g_title'					=> __('fluxbb_installer::seed_data.members'),
			'g_user_title'				=> null,
			'g_promote_min_posts'		=> 0,
			'g_promote_next_group'		=> 0,
			'g_moderator'				=> 0,
			'g_mod_edit_users'			=> 0,
			'g_mod_rename_users'		=> 0,
			'g_mod_change_passwords'	=> 0,
			'g_mod_ban_users'			=> 0,
			'g_read_board'				=> 1,
			'g_view_users'				=> 1,
			'g_post_replies'			=> 1,
			'g_post_topics'				=> 1,
			'g_edit_posts'				=> 1,
			'g_delete_posts'			=> 1,
			'g_delete_topics'			=> 1,
			'g_post_links'				=> 1,
			'g_set_title'				=> 0,
			'g_search'					=> 1,
			'g_search_users'			=> 1,
			'g_send_email'				=> 1,
			'g_post_flood'				=> 60,
			'g_search_flood'			=> 30,
			'g_email_flood'				=> 60,
			'g_report_flood'			=> 60,
		));
	}

	protected function seed_users()
	{
		// Insert guest and first admin user
		User::create(array(
			'group_id'	=> 3,
			'username'	=> __('fluxbb_installer::seed_data.guest'),
			'password'	=> __('fluxbb_installer::seed_data.guest'),
			'email'		=> __('fluxbb_installer::seed_data.guest'),
		));

		User::create(array(
			'group_id'			=> 1,
			'username'			=> 'username',
			'password'			=> 'password1',
			'email'				=> 'email',
			'language'			=> 'en',
			'style'				=> 'Air',
			'num_posts'			=> 1,
			'last_post'			=> Request::time(),
			'registered'		=> Request::time(),
			'registration_ip'	=> Request::ip(),
			'last_visit'		=> Request::time(),
		));
	}

	protected function seed_config()
	{
		// Enable/disable avatars depending on file_uploads setting in PHP configuration
		$avatars = in_array(strtolower(@ini_get('file_uploads')), array('on', 'true', '1')) ? 1 : 0;

		// Insert config data
		$config = array(
			'o_cur_version'				=> FLUXBB_VERSION,
			'o_board_title'				=> $title,
			'o_board_desc'				=> $description,
			'o_default_timezone'		=> 0,
			'o_time_format'				=> 'H:i:s',
			'o_date_format'				=> 'Y-m-d',
			'o_timeout_visit'			=> 1800,
			'o_timeout_online'			=> 300,
			'o_redirect_delay'			=> 1,
			'o_show_version'			=> 0,
			'o_show_user_info'			=> 1,
			'o_show_post_count'			=> 1,
			'o_signatures'				=> 1,
			'o_smilies'					=> 1,
			'o_smilies_sig'				=> 1,
			'o_make_links'				=> 1,
			'o_default_lang'			=> $default_lang,
			'o_default_style'			=> $default_style,
			'o_default_user_group'		=> 4,
			'o_topic_review'			=> 15,
			'o_disp_topics_default'		=> 30,
			'o_disp_posts_default'		=> 25,
			'o_indent_num_spaces'		=> 4,
			'o_quote_depth'				=> 3,
			'o_quickpost'				=> 1,
			'o_users_online'			=> 1,
			'o_censoring'				=> 0,
			'o_show_dot'				=> 0,
			'o_topic_views'				=> 1,
			'o_quickjump'				=> 1,
			'o_gzip'					=> 0,
			'o_additional_navlinks'		=> '',
			'o_report_method'			=> 0,
			'o_regs_report'				=> 0,
			'o_default_email_setting'	=> 1,
			'o_mailing_list'			=> $email,
			'o_avatars'					=> $avatars,
			'o_avatars_dir'				=> 'img/avatars',
			'o_avatars_width'			=> 60,
			'o_avatars_height'			=> 60,
			'o_avatars_size'			=> 10240,
			'o_search_all_forums'		=> 1,
			'o_base_url'				=> $base_url,
			'o_admin_email'				=> $email,
			'o_webmaster_email'			=> $email,
			'o_forum_subscriptions'		=> 1,
			'o_topic_subscriptions'		=> 1,
			'o_smtp_host'				=> NULL,
			'o_smtp_user'				=> NULL,
			'o_smtp_pass'				=> NULL,
			'o_smtp_ssl'				=> 0,
			'o_regs_allow'				=> 1,
			'o_regs_verify'				=> 0,
			'o_announcement'			=> 0,
			'o_announcement_message'	=> __('fluxbb_installer::seed_data.announcement'),
			'o_rules'					=> 0,
			'o_rules_message'			=> __('fluxbb_installer::seed_data.rules'),
			'o_maintenance'				=> 0,
			'o_maintenance_message'		=> __('fluxbb_installer::seed_data.maintenance_message'),
			'o_default_dst'				=> 0,
			'o_feed_type'				=> 2,
			'o_feed_ttl'				=> 0,
			'p_message_bbcode'			=> 1,
			'p_message_img_tag'			=> 1,
			'p_message_all_caps'		=> 1,
			'p_subject_all_caps'		=> 1,
			'p_sig_all_caps'			=> 1,
			'p_sig_bbcode'				=> 1,
			'p_sig_img_tag'				=> 0,
			'p_sig_length'				=> 400,
			'p_sig_lines'				=> 4,
			'p_allow_banned_email'		=> 1,
			'p_allow_dupe_email'		=> 0,
			'p_force_guest_email'		=> 1
		);

		foreach ($config as $conf_name => $conf_value)
		{
			Config::set($conf_name, $conf_value);
		}

		Config::save();
	}

	protected function seed_content()
	{
		// Insert some default content
		Category::create(array(
			'id'			=> 1,
			'cat_name'		=> __('fluxbb_installer::seed_data.test_category'),
			'disp_position'	=> 1,
		));

		Forum::create(array(
			'id'			=> 1,
			'forum_name'	=> __('fluxbb_installer::seed_data.test_forum'),
			'forum_desc'	=> __('fluxbb_installer::seed_data.test_forum_desc'),
			'num_topics'	=> 1,
			'num_posts'		=> 1,
			'last_post'		=> Request::time(),
			'last_post_id'	=> 1,
			'last_poster'	=> 'admin', // FIXME!!!
			'disp_position'	=> 1,
			'cat_id'		=> 1,
		));

		Topic::create(array(
			'id'			=> 1,
			'poster'		=> 'admin', // FIXME!!!
			'subject'		=> __('fluxbb_installer::seed_data.test_post'),
			'posted'		=> Request::time(),
			'first_post_id'	=> 1,
			'last_post'		=> Request::time(),
			'last_post_id'	=> 1,
			'last_poster'	=> 'admin', // FIXME!!!
			'forum_id'		=> 1,
		));

		Post::create(array(
			'id'		=> 1,
			'poster'	=> 'admin', // FIXME!!!
			'poster_id'	=> 2,
			'poster_ip'	=> Request::ip(),
			'message'	=> __('fluxbb_installer::seed_data.message'),
			'posted'	=> Request::time(),
			'topic_id'	=> 1,
		));

		// TODO: Update search index, hehe. Is that a hook? (event)
	}

	protected function path()
	{
		return Bundle::path('fluxbb').'migrations'.DS.'install'.DS;
	}

}
