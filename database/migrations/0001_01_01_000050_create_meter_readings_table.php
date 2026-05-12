<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('before_water_general')->nullable();
            $table->bigInteger('after_water_general')->nullable();
            $table->bigInteger('before_water_cdj')->nullable();
            $table->bigInteger('after_water_cdj')->nullable();
            $table->bigInteger('before_electricity_general')->nullable();
            $table->bigInteger('after_electricity_general')->nullable();
            $table->bigInteger('before_electricity_cdj')->nullable();
            $table->bigInteger('after_electricity_cdj')->nullable();
            $table->bigInteger('before_mazout_general')->nullable();
            $table->bigInteger('after_mazout_general')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meter_readings');
    }
};
