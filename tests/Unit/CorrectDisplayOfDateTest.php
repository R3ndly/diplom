<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\VacanciesController;
use App\Models\Vacancies;

class CorrectDisplayOfDateTest extends TestCase
{
    public function test_correct_display_of_date(): void
    {
        // Создайте запись в базе данных
        $vacancy = Vacancies::factory()->create([
            'published_at' => '2020-10-10 00:00:00',
        ]);

        // Создайте экземпляр контроллера
        $controller = new VacanciesController();

        // Вызовите метод контроллера с экземпляром модели
        $view = $controller->show($vacancy);

        // Проверьте содержимое представления
        $this->assertStringContainsString('10.10.2020', $view->render());
    }
}

