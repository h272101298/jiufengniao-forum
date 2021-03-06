<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('int_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid')->comment('用户id');
            $table->string('value',255)->comment('值');
            $table->tinyInteger('mode',4)->comment('0:下注,1:充值');
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
        Schema::dropIfExists('int_details');
    }
}
