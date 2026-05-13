<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_albums', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_path', 1000)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_album_id')->nullable()->constrained('media_albums')->nullOnDelete();

            $table->string('media_type')->default('image'); // image, video, youtube
            $table->string('title');
            $table->text('caption')->nullable();

            $table->string('file_path', 1000)->nullable();
            $table->string('thumbnail_path', 1000)->nullable();
            $table->string('video_url', 1000)->nullable();

            $table->string('tags')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('taken_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_items');
        Schema::dropIfExists('media_albums');
    }
};
