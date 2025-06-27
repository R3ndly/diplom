<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VacanciesFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'title' => $faker->jobTitle(),
            'description' => $faker->sentence(50),
            'department_id' => $faker->numberBetween(1,5),
            'location_id' => $faker->numberBetween(1,3),
            'working_hours_id' => $faker->numberBetween(1, 3),
            'worker_id' => $faker->numberBetween(1,30),
            'salary' => $faker->numerify('##000'),
            'published_at' => $faker->date(),
        ];
    }
}
