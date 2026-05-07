<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // REQUIRED (every member has a name, duh)
            $table->string('role'); // REQUIRED (they all do something)
            $table->string('image')->nullable(); // OPTIONAL (maybe image later) just optional s !!!
            $table->string('quote')->nullable(); // OPTIONAL (not everyone needs a quote) just optional s !!!
            $table->string('nickname')->nullable(); // OPTIONAL (some members don't use one) just optional s !!!
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};