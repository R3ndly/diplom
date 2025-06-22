<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('education')->count() == 0) {
            DB::table('education')->insert([
                ['education_name' => 'Имеется'],
                ['education_name' => 'Отсутствует'],
            ]);
        }
    }
}
