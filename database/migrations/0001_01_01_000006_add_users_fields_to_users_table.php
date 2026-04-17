<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('email')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('phone')->after('last_name');
            $table->date('birth_date')->after('phone')->nullable();
            $table->string('sex')->after('birth_date')->nullable();
            $table->string('city')->after('sex');
            $table->string('postal_code')->after('city');
            $table->string('address')->after('postal_code');
            $table->string('status')->after('address');
            $table->json('identity_card_paths')->after('status')->nullable();
            $table->string('avatar_path')->after('identity_card_paths')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'birth_date',
                'sex',
                'city',
                'postal_code',
                'address',
                'status',
                'identity_card_paths',
                'avatar_path'
            ]);
        });
    }
};
