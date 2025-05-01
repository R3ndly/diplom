<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products;
use Illuminate\Support\Facades\File;

class ProductsFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'title' => $faker->randomElement(['Умный мотор для рулонных штор', 'Датчик открытия дверей и окон', 'Терморегулятор', 'Умный привод перекрытия газа',
            'Конденсатор для умных переключателей', 'Умный датчик протечки воды', 'Датчик температуры']),
            'price' => $faker->numerify('###0'),
            'brand' => $faker->company(),
            'delivery' => $faker->date(),
            'category' => $faker->randomElement(['Датчик, устройство сбора и передачи данных', 'Исполнительный элемент', 'Модуль в розетку']),
            'warranty' => $faker->randomElement(['1 год', '2 года', '5 лет', '10 лет', '15 лет']),
            'material' => $faker->randomElement(['Пластик', 'Комбинированные материалы']),
            'power_supply' => $faker->randomElement(['Батареек', 'Сети 220']),
            'product_image' => $this->randomImage()
        ];
    }

    public function randomImage() 
    {
        $pathToFolderImagesOfProducts = public_path('img/products');
        $Images = File::files($pathToFolderImagesOfProducts);

        if (empty($Images)) {
            return 'нету файлов';
        }

        $randomImages = $Images[array_rand($Images)];

        return 'img/products/' . basename($randomImages);
    }
}
