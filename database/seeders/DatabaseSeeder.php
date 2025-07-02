<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Food;
use App\Models\Treatment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(DeviceStatusSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(TreatmentSeeder::class);
        $this->call(EntrySeeder::class);
        $this->call(ProfileSeeder::class);
    }
}
