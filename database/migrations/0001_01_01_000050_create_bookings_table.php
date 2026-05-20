<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid');
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete();
            $table->foreignId('hall_rate_id')->nullable()->constrained('hall_rates')->nullOnDelete();
            $table->foreignId('booking_date_id')->nullable()->constrained('booking_dates')->nullOnDelete();
            $table->string('company_name')->nullable();
            $table->string('deposit_status');
            $table->bigInteger('prepayment')->nullable();
            $table->text('message')->nullable();
            $table->string('billing_address');
            $table->bigInteger('cleaning')->nullable();
            $table->bigInteger('breaking')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
