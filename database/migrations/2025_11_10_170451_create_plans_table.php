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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Free, Pro, Business
            $table->string('slug')->unique();
            $table->string('stripe_price_id')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('interval')->default('month'); // month, year
            $table->integer('max_links')->nullable(); // null = unlimited
            $table->integer('max_clicks_per_link')->nullable();
            $table->integer('max_custom_domains')->default(0);
            $table->boolean('analytics')->default(false);
            $table->boolean('api_access')->default(false);
            $table->boolean('priority_support')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->text('features')->nullable(); // JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
