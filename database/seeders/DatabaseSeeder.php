<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Main upgraded content seed for BangTanSonyeondan.
        $this->call(GlowUpContentSeeder::class);
    }
}


