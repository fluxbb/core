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

class Migration_Forums
{

	public function up()
	{
		Schema::table('forums', function($table)
		{
			$table->create();

			$table->increments('id');
			// TODO: Localize string?
			$table->string('forum_name', 80)->default('New forum');
			$table->text('forum_desc')->nullable();
			$table->string('redirect_url', 100)->nullable();
			// TODO: Remove moderators column
			$table->text('moderators')->nullable();
			$table->integer('num_topics')->default(0);
			$table->integer('num_posts')->default(0);
			$table->integer('last_post')->nullable();
			$table->integer('last_post_id')->nullable();
			$table->string('last_poster', 200)->nullable();
			// TODO: Really a boolean (or multiple options)?
			$table->boolean('sort_by')->default(false);
			$table->integer('disp_position')->default(0);
			// TODO: Do we really need a default here?
			$table->integer('cat_id')->default(0);

			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('forums');
	}

}