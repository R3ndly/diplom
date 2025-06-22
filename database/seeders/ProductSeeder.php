<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Products::factory()->count(100)->create();
    }
}
