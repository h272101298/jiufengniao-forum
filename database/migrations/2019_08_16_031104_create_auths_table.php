<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('auth_name')->comment('权限组名称');
            $table->string('controller',40)->nullable($value = true)->comment('不带后缀的权限对应的控制器文件名');
            $table->string('action',30)->nullable($value = true)->comment('权限对应的方法名称');
            $table->unsignedInteger('pid')->default(0)->comment('权限的父级id');
            $table->unsignedTinyInteger('is_nav')->default(1)->comment('是否作为菜单,1:是,2:否');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auths');
    }
}
