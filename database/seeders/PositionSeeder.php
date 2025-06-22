<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Positions;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Positions::factory()->count(10)->create();
    }
}
