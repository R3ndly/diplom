<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(VacanciesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(WorkerSeeder::class);
    }
}
