<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bt21_characters')) {
            Schema::create('bt21_characters', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('member_name')->nullable();
                $table->string('emoji', 40)->nullable();
                $table->string('image')->nullable();
                $table->string('accent_color', 30)->default('#a855f7');
                $table->string('mood', 500)->nullable();
                $table->string('power', 500)->nullable();
                $table->json('anatomy')->nullable();
                $table->json('moves')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bt21_characters');
    }
};
