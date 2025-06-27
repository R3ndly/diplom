<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('departments')->count() == 0) {
            DB::table('departments')->insert([
                ['department' => 'HR'],
                ['department' => 'Менеджмент'],
                ['department' => 'Разработка'],
                ['department' => 'Тестирование'],
                ['department' => 'Безопасность']
            ]);
        }
    }
}
