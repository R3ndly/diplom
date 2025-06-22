<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Worker;
class WorkerSeeder extends Seeder
{
    public function run(): void
    {
        Worker::factory()->count(100)->create();
    }
}
