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
        Schema::create('task_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tasks');
            $table->string('file_path')->nullable();
            $table->longText('location_information')->nullable();
            $table->timestamps();
            $table->foreign('id_tasks')->references('id')->on('tasks')->onDelete('cascade');
            $table->index('id');
            $table->index('id_tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_info');
    }
};
