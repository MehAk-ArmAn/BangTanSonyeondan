<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminStarterSeeder extends Seeder
{
    public function run(): void
    {
        // Kept for your earlier command compatibility.
        // The real upgraded content now lives in GlowUpContentSeeder.
        $this->call(GlowUpContentSeeder::class);
    }
}

