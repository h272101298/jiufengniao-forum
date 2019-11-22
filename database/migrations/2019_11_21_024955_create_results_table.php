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
            $table->integer('num')->comment('期数');
            $table->string('preDrawCode')->comment('开奖结果');
            $table->tinyInteger('sumFS')->comment('冠亚和');
            $table->tinyInteger('sumBigSamll')->comment('大小');
            $table->tinyInteger('sumSingleDouble')->comment('单双');
            $table->tinyInteger('firstDT')->comment('龙虎1');
            $table->tinyInteger('secondDT')->comment('龙虎2');
            $table->tinyInteger('thirdDT')->comment('龙虎3');
            $table->tinyInteger('fourthDT')->comment('龙虎4');
            $table->tinyInteger('fifthDT')->comment('龙虎5');
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
