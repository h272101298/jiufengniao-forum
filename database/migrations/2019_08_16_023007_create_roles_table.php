<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name',20)->comment('角色名');//角色名 varchar（20） 不能为空
            $table->text('auth_ids')->nullable()->comment('权限表主键id组');//权限表主键id组，如1,2,3
            $table->text('auth_ac')->nullable()->comment('权限对应的控制器和方法集合');//权限对应的控制器和方法集合 如admincontroller@index,indexcontroller@index
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
        Schema::dropIfExists('roles');
    }
}
