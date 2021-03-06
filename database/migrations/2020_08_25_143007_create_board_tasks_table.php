<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boards_id');
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->date('start_date');
            $table->date('due_date');
            $table->string('tags')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('boards_id')->references('id')->on('boards')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_tasks');
    }
}
