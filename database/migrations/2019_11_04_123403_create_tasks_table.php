<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('status_id')->unsigned()->default('1');
            $table->integer('creator_id')->unsigned();
            $table->integer('assigned_to_id')->unsigned()->nullable();

            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('task_statuses');
            $table->foreign('assigned_to_id')->references('id')->on('users');
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
        Schema::dropIfExists('tasks');
    }
}
