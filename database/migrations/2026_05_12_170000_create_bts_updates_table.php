<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bts_updates', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category')->nullable();
            $table->string('source_label')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();

            $table->string('image_path', 1000)->nullable();
            $table->string('video_url', 1000)->nullable();
            $table->string('video_path', 1000)->nullable();

            $table->json('links')->nullable();

            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamp('published_at')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bts_updates');
    }
};