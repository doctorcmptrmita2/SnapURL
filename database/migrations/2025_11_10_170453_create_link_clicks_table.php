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
        Schema::create('link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->string('ip_hash'); // hashed IP for privacy
            $table->string('user_agent_hash')->nullable(); // hashed UA
            $table->string('country', 2)->nullable();
            $table->string('city')->nullable();
            $table->string('referrer')->nullable();
            $table->string('device_type')->nullable(); // desktop, mobile, tablet
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->timestamp('clicked_at');
            $table->timestamps();
            
            $table->index(['link_id', 'clicked_at']);
            $table->index(['ip_hash', 'link_id']); // for unique counting
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_clicks');
    }
};
