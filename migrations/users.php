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

class Migration_Users
{

	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->create();

			$table->increments('id');
			$table->integer('group_id');
			$table->string('username', 200);
			$table->string('password', 40);
			$table->string('email', 80);
			$table->string('title', 50)->nullable();
			$table->string('realname', 40)->nullable();
			$table->string('url', 100)->nullable();
			$table->string('location', 30)->nullable();
			$table->text('signature')->nullable();
			$table->integer('disp_topics')->nullable();
			$table->integer('disp_posts')->nullable();
			$table->integer('email_setting'); // TODO: Meh, pretty large for a TINYINT with three possible values
			$table->boolean('notify_with_post');
			$table->boolean('auto_notify');
			$table->boolean('show_smilies');
			$table->boolean('show_img');
			$table->boolean('show_img_sig');
			$table->boolean('show_avatars');
			$table->boolean('show_sig');
			$table->float('timezone');
			$table->boolean('dst');
			$table->integer('time_format');
			$table->integer('date_format');
			$table->string('language', 25)
			$table->string('style', 25);
			$table->integer('num_posts');
			$table->integer('last_post')->nullable();
			$table->integer('last_search')->nullable();
			$table->integer('last_email_sent')->nullable();
			$table->integer('last_report_sent')->nullable();
			$table->integer('registered');
			$table->string('registration_ip', 35);
			$table->integer('last_visit');
			$table->string('admin_note', 30)->nullable();
			$table->string('activate_string', 80)->nullable();
			$table->string('activate_key', 8)->nullable(); // TODO: A little short maybe?

			$table->primary('id');
			$table->unique('username');
			$table->index('registered');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}