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
            $table->foreignId('plan_id')->nullable()->after('id')->constrained()->onDelete('set null');
            $table->boolean('is_admin')->default(false)->after('email_verified_at');
            $table->string('stripe_customer_id')->nullable()->after('is_admin');
            $table->timestamp('trial_ends_at')->nullable()->after('stripe_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn(['plan_id', 'is_admin', 'stripe_customer_id', 'trial_ends_at']);
        });
    }
};
