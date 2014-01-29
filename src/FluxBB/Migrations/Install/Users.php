<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->create();

            $table->increments('id');
            $table->integer('group_id')->unsigned()->default(3);
            $table->string('username', 200)->default('');
            $table->string('password', 60)->default('');
            $table->string('email', 80)->default('');
            $table->string('title', 50)->nullable();
            $table->string('realname', 40)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('location', 30)->nullable();
            $table->text('signature')->nullable();
            $table->integer('disp_topics')->unsigned()->nullable();
            $table->integer('disp_posts')->unsigned()->nullable();
            $table->integer('email_setting')->unsigned()->default(1);
            $table->boolean('notify_with_post')->default(false);
            $table->boolean('auto_notify')->default(false);
            $table->boolean('show_smilies')->default(true);
            $table->boolean('show_img')->default(true);
            $table->boolean('show_img_sig')->default(true);
            $table->boolean('show_avatars')->default(true);
            $table->boolean('show_sig')->default(true);
            $table->float('timezone')->default(0);
            $table->boolean('dst')->default(false);
            $table->integer('time_format')->unsigned()->default(0);
            $table->integer('date_format')->unsigned()->default(0);
            $table->string('language', 25)->default('');
            $table->string('style', 25)->default('');
            $table->integer('num_posts')->unsigned()->default(0);
            $table->integer('last_post')->unsigned()->nullable();
            $table->integer('last_search')->unsigned()->nullable();
            $table->integer('last_email_sent')->unsigned()->nullable();
            $table->integer('last_report_sent')->unsigned()->nullable();
            $table->integer('registered')->unsigned()->default(0);
            $table->string('registration_ip', 35)->default('0.0.0.0');
            $table->integer('last_visit')->unsigned()->default(0);
            $table->string('admin_note', 30)->nullable();
            $table->string('activate_string', 80)->nullable();
            $table->string('activate_key', 8)->nullable();

            $table->unique('username');
            $table->index('registered');
        });
    }

    public function down()
    {
        Schema::drop('users');
    }

}