<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('ip')->nullable();
            $table->enum('status', ['ON', 'OFF']);
            $table->bigInteger('device_category_id')->unsigned();
            $table->foreign('device_category_id')->references('id')->on('device_categories')->onDelete('cascade');
            $table->bigInteger('farm_id')->unsigned();
            $table->foreign('farm_id')->references('id')->on('farms')->onDelete('cascade');
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
        Schema::dropIfExists('devices');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
