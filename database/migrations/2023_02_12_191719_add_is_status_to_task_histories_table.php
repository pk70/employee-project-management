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
        Schema::table('task_histories', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->comment('1 is for pending 2 is for completed');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_histories', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
