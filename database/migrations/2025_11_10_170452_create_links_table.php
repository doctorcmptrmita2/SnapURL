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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('slug')->unique()->index();
            $table->text('destination_url');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('password')->nullable(); // hashed
            $table->timestamp('expires_at')->nullable();
            $table->integer('max_clicks')->nullable();
            $table->integer('click_count')->default(0);
            $table->integer('unique_click_count')->default(0);
            $table->enum('status', ['active', 'paused', 'expired'])->default('active');
            $table->string('custom_domain')->nullable();
            $table->boolean('is_public')->default(true);
            $table->string('ip_hash')->nullable(); // hashed IP for privacy
            $table->timestamps();
            
            $table->index(['slug', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
