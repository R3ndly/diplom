<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Working_hoursSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('working_hours')->count() == 0) {
            DB::table('working_hours')->insert([
                ['working_hours' => 'Полный рабочий день'],
                ['working_hours' => 'Частичная занятость'],
                ['working_hours' => 'Проектная работа']
            ]);
        }
    }
}
