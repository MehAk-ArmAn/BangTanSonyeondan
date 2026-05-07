<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Main upgraded content seed for the BTS archive.
        $this->call(GlowUpContentSeeder::class);
    }
}
