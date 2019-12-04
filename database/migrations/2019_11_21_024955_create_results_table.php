<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('preDrawTime')->comment('开奖时间');
            $table->string('preDrawIssue')->comment('期数');
            $table->string('preDrawCode')->nullable($value = true)->comment('开奖结果');
            $table->tinyInteger('firstNum')->nullable($value = true)->comment('第一名');
            $table->tinyInteger('secondNum')->nullable($value = true)->comment('第二名');
            $table->tinyInteger('thirdNum')->nullable($value = true)->comment('第三名');
            $table->tinyInteger('fourthNum')->nullable($value = true)->comment('第四名');
            $table->tinyInteger('fifthNum')->nullable($value = true)->comment('第五名');
            $table->tinyInteger('sixthNum')->nullable($value = true)->comment('第六名');
            $table->tinyInteger('seventhNum')->nullable($value = true)->comment('第七名');
            $table->tinyInteger('eighthNum')->nullable($value = true)->comment('第八名');
            $table->tinyInteger('ninthNum')->nullable($value = true)->comment('第九名');
            $table->tinyInteger('tenthNum')->nullable($value = true)->comment('第十名');
            $table->tinyInteger('sumFS')->nullable($value = true)->comment('冠亚和');
            $table->tinyInteger('sumBigSamll')->nullable($value = true)->comment('大小');
            $table->tinyInteger('sumSingleDouble')->nullable($value = true)->comment('单双');
            $table->tinyInteger('firstDT')->nullable($value = true)->comment('龙虎1');
            $table->tinyInteger('secondDT')->nullable($value = true)->comment('龙虎2');
            $table->tinyInteger('thirdDT')->nullable($value = true)->comment('龙虎3');
            $table->tinyInteger('fourthDT')->nullable($value = true)->comment('龙虎4');
            $table->tinyInteger('fifthDT')->nullable($value = true)->comment('龙虎5');
            $table->tinyInteger('groupCode');
            $table->dateTime('drawTime')->comment('下期开奖时间');
            $table->string('drawIssue')->comment('下期期数');
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
        Schema::dropIfExists('results');
    }
}
