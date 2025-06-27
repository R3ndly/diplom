<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacancies;

class VacanciesSeeder extends Seeder
{
    public function run(): void
    {
        Vacancies::factory()->count(30)->create();
    }
}
