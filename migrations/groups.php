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

class Migration_Groups
{

	public function up()
	{
		Schema::table('groups', function($table)
		{
			$table->create();

			$table->increments('g_id');
			$table->string('g_title', 50);
			$table->string('g_user_title')->nullable();
			$table->integer('g_promote_min_posts');
			$table->integer('g_promote_next_group');
			$table->boolean('g_moderator');
			$table->boolean('g_mod_edit_users');
			$table->boolean('g_mod_rename_users');
			$table->boolean('g_mod_change_passwords');
			$table->boolean('g_mod_ban_users');
			$table->boolean('g_read_board');
			$table->boolean('g_view_users');
			$table->boolean('g_post_replies');
			$table->boolean('g_post_topics');
			$table->boolean('g_edit_posts');
			$table->boolean('g_delete_posts');
			$table->boolean('g_delete_topics');
			$table->boolean('g_post_links');
			$table->boolean('g_set_title');
			$table->boolean('g_search');
			$table->boolean('g_search_users');
			$table->boolean('g_send_email');
			$table->integer('g_post_flood');
			$table->integer('g_search_flood');
			$table->integer('g_email_flood');
			$table->integer('g_report_flood');

			$table->primary('g_id');
		});
	}

	public function down()
	{
		Schema::drop('groups');
	}

}