<?php
namespace Database\Factories;

use App\Models\Vacancies;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacanciesFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'title' => $faker->jobTitle(),
            'description' => $faker->sentence(50),
            'department' => $faker->jobTitle(),
            'location' => $faker->randomElement(['В офисе', 'Удалённо']),
            'type' => $faker->randomElement(['Полный рабочий день', 'Сокращённый рабочий день']),
            'salary' => $faker->numerify('##000'),
            'published_at' => $faker->date(),
            'contact_email' => $faker->unique()->safeEmail(),
            'contact_phone' => $faker->phoneNumber()
        ];
    }
}
