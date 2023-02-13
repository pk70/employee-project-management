<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tasks');
            $table->string('break')->nullable();
            $table->timestamp('task_start')->nullable();
            $table->timestamp('task_end')->nullable();
            $table->timestamp('break_start')->nullable();
            $table->timestamp('break_end')->nullable();
            $table->string('task_details')->nullable();
            $table->timestamps();
            $table->foreign('id_tasks')->references('id')->on('tasks')->onDelete('cascade');
            $table->index('id');
            $table->index('id_tasks');
            $table->index('break');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_histories');
    }
};
