<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Profile::factory()->count(20)->create();
    }
}