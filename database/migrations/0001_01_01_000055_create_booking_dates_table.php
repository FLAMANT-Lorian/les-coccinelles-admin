<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->timestamp('key_handover_date');
            $table->time('key_handover_hour');
            $table->timestamp('key_return_date');
            $table->time('key_return_hour');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_dates');
    }
};
