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

class FluxBB_Update_Groups_Promotion
{
	
	public function up()
	{
		Schema::table('groups', function($table)
		{
			$table->integer('g_promote_min_posts')->unsigned()->default(0)->after('g_user_title');
			$table->integer('g_promote_next_group')->unsigned()->default(0)->after('g_promote_min_posts');
		});
	}

	public function down()
	{
		Schema::table('groups', function($table)
		{
			$table->drop_column(array('g_promote_min_posts', 'g_promote_next_group'));
		});
	}

}