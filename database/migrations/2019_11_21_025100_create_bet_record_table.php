<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->comment('期数');
            $table->integer('userid')->comment('用户id');
            $table->integer('rankid')->comment('名次id');
            $table->float('price',2)->comment('下注金额');
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
        Schema::dropIfExists('bet_record');
    }
}
