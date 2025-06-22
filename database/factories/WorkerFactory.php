<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'name' => $faker->firstNameMale(),
            'surname' => $faker->lastNameMale(),
            'patronymic' => $faker->firstNameMale(),
            'position_id' => $faker->numberBetween(1,10),
            'salary' => $faker->numerify('##000'),
            'hire_date' => $faker->date(),
            'education_id' => $faker->numberBetween(1,2),
            'phone_number' => $faker->e164PhoneNumber(16),
            'email' => $faker->unique()->safeEmail(),
        ];
    }
}
