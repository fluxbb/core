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

class FluxBB_Migration_Reports
{

	public function up()
	{
		Schema::table('reports', function($table)
		{
			$table->create();

			$table->increments('id');
			$table->integer('post_id')->default(0);
			$table->integer('topic_id')->default(0);
			$table->integer('forum_id')->default(0);
			$table->integer('reported_by')->default(0);
			$table->integer('created')->default(0);
			$table->text('message')->nullable();
			$table->integer('zapped')->nullable();
			$table->integer('zapped_by')->nullable();
			
			$table->primary('id');

			$table->index('zapped');
		});
	}

	public function down()
	{
		Schema::drop('reports');
	}

}