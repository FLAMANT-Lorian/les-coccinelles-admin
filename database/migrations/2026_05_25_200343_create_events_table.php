<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid');
            $table->string('name');
            $table->timestamp('date');
            $table->time('hour');
            $table->string('address');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
