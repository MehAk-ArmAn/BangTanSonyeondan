<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    // Runs when you migrate
    public function up(): void
    {
        // Create table named "bts_copies"
        Schema::create('bts_copies', function (Blueprint $table) {
            $table->id();  // primary key id (auto increment)

            $table->string('bts_name', 120);  // BTS name text
            $table->string('copy_extra_name', 120)->nullable();  // optional extra name
            $table->string('copy_title', 200);  // title of the copy
            $table->text('description')->nullable();  // long optional description

            $table->timestamps();  // created_at + updated_at

            // Prevent duplicate rows with same bts_name and copy_title
            $table->unique(['bts_name', 'copy_title']);
        });
    }

    // Runs when you rollback
    public function down(): void
    {
        Schema::dropIfExists('bts_copies');
    }
};
