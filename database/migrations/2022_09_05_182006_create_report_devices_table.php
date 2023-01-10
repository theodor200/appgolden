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
        Schema::create('report_devices', function (Blueprint $table) {
            $table->id();
            $table->string('item_id')->unique();
            $table->string('customer_id');
            $table->string('serial')->unique();
            $table->string('model');
            $table->string('partnumber');
            $table->string('site');
            $table->string('customer_name');
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
        Schema::dropIfExists('report_devices');
    }
};
