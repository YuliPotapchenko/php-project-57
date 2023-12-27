<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_label', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('task_id')->nullable();
            $table->bigInteger('label_id')->nullable();
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('label_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_label');
    }
}
