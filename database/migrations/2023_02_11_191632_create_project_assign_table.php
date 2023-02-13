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
        Schema::create('project_assign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->string('user_name');
            $table->bigInteger('assigned_user_id');
            $table->string('user_response')->nullable();
            $table->timestamps();
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
            $table->index('id');
            $table->index('id_project');
            $table->index('assigned_user_id');
            $table->index('user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_assign');
    }
};
