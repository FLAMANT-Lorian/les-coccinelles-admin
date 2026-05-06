<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hall_rates', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('base_price');
            $table->bigInteger('member_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_rates');
    }
};
