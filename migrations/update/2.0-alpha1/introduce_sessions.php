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

class FluxBB_Update_Introduce_Sessions
{
	
	public function up()
	{
		// Create the table to hold session data
		Schema::table('sessions', function($table)
		{
			$table->create();

			$table->string('id', 40);
			$table->integer('user_id')->unsigned()->default(1);
			$table->integer('created')->unsigned()->default(0);
			$table->integer('last_visit')->unsigned()->default(0);
			$table->string('last_ip', 200)->default('0.0.0.0');
			$table->text('data');

			$table->primary('id');
			$table->index('user_id');
		});

		// ... and delete the old online table
		Schema::drop('online');
	}

	public function down()
	{
		Schema::drop('sessions');

		Schema::table('online', function($table)
		{
			$table->create();

			$table->integer('user_id')->unsigned()->default(1);
			$table->string('ident', 200)->default('');
			$table->integer('logged')->unsigned()->default(0);
			$table->boolean('idle')->default(false);
			$table->integer('last_post')->unsigned()->nullable();
			$table->integer('last_search')->unsigned()->nullable();

			$table->unique(array('user_id', 'ident'));
			$table->index('ident');
			$table->index('logged');
		});
	}

}