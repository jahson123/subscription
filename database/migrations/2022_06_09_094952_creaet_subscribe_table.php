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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->integer('msisdn');
            $table->string('shortcode');
            $table->string('keyword');
            $table->string('status');
            $table->string('service');
            $table->float('charge_price');
            $table->dateTime('unsubscribe_time', $precision = 0)->nullable();
            $table->dateTime('subscribe_time', $precision = 0)->nullable();
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
        Schema::dropIfExists('subscribes');
    }
};
