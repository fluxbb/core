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

class FluxBB_Update_Remove_Search_Tables
{
	
	public function up()
	{
		Schema::drop('search_cache');
		Schema::drop('search_matches');
		Schema::drop('search_words');
	}

	public function down()
	{
		Schema::table('search_cache', function($table)
		{
			$table->create();

			$table->integer('id')->unsigned();
			$table->string('ident', 200)->default('');
			$table->text('search_data')->nullable();

			$table->primary('id');
			$table->index('ident');
		});

		Schema::table('search_matches', function($table)
		{
			$table->create();

			$table->integer('post_id')->unsigned();
			$table->integer('word_id')->unsigned();
			$table->boolean('subject_match')->default(false);

			$table->index('word_id');
			$table->index('post_id');
		});

		Schema::table('search_words', function($table)
		{
			$table->create();

			$table->increments('id');
			$table->string('word', 20)->default('');

			$table->unique('word');
		});
	}

}