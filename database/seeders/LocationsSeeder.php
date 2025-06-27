<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('locations')->count() == 0) {
            DB::table('locations')->insert([
                ['location' => 'Удалённо'],
                ['location' => 'Офис'],
                ['location' => 'Гибрид']
            ]);
        }
    }
}
