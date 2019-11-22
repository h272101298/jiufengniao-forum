<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->comment('登录账户');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('登陆密码');
            $table->float('cur_integral',4)->comment('当前积分');
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
        Schema::dropIfExists('bet_user');
    }
}
