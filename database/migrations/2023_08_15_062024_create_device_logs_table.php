<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDeviceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->bigInteger('old_category_id')->unsigned()->nullable();
            $table->foreign('old_category_id')->references('id')->on('device_categories')->onDelete('cascade');
            $table->bigInteger('new_category_id')->unsigned()->nullable();
            $table->foreign('new_category_id')->references('id')->on('device_categories')->onDelete('cascade');
            $table->enum('action', ['CREATE', 'EDIT', 'DESTROY', 'CHANGE_STATUS'])->nullable();
            $table->enum('old_status', ['ON', 'OFF'])->nullable();
            $table->enum('new_status', ['ON', 'OFF'])->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('device_logs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
