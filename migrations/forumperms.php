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

class Migration_ForumPerms
{

	public function up()
	{
		Schema::table('forum_perms', function($table)
		{
			$table->create();

			$table->increments('id');
			$table->integer('group_id');
			$table->integer('forum_id');
			$table->boolean('read_forum');
			$table->boolean('post_replies');
			$table->boolean('post_topics');

			$table->primary(array('group_id', 'forum_id'));
		});
	}

	public function down()
	{
		Schema::drop('forum_perms');
	}

}