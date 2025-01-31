<?php
namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

        $fatherName = $faker->firstNameMale();

        return [
            'name' => $faker->firstName(),
            'surname' => $faker->lastName(),
            'patronymic' => $this->generatePatronymic($fatherName),
            'position' => $faker->jobTitle(), 
            'salary' => $faker->randomFloat(2, 30000, 150000),
            'hire_date' => $faker->date(),
            'education' => $faker->boolean(), 
            'phone_number' => substr($faker->phoneNumber(), 0, 15),
            'email' => $faker->unique()->safeEmail(),
        ];
    }

    private function generatePatronymic($fatherName)
    {
        $suffix = (mb_substr($fatherName, -1) === 'а') ? 'овна' : 'ович'; 

        return $fatherName . $suffix; 
    }
}
