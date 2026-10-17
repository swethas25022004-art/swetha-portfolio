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
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitor_id');
            $table->string('page', 32);
            $table->string('source')->nullable();
            $table->string('country', 2)->nullable();
            $table->timestamps();

            $table->index(['created_at', 'page']);
            $table->index(['created_at', 'source']);
            $table->index(['created_at', 'visitor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
