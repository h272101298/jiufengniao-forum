<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('登陆密码');
            $table->rememberToken();
            $table->string('last_login_ip')->comment('最后登陆IP');
            $table->integer('last_login_time')->comment('最后登陆时间');
            $table->tinyInteger('role_id')->comment('角色id');
            $table->tinyInteger('status')->default('0')->comment('用户状态:1为开启,0为关闭');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
