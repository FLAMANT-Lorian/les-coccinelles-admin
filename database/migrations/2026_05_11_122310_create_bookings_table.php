<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete();
            $table->foreignId('hall_rate_id')->nullable()->constrained('hall_rates')->nullOnDelete();
            $table->foreignId('meter_reading_id')->constrained('meter_readings')->cascadeOnDelete();
            $table->string('status');
            $table->string('key_handover_date');
            $table->string('key_return_date');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('message')->nullable();
            $table->string('billing_address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
