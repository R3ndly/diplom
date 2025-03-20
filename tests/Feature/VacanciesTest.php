<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Vacancies;

class VacanciesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Проверяем, существует ли администратор, и создаем его только если он не существует
        $this->adminUser = User::firstOrCreate(
            ['email' => 'admin@mail.ru'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Q1qqqqqq'), // Используйте хешированный пароль
                'role' => 'admin', // Убедитесь, что у вас есть поле role
            ]
        );

        // Аутентифицируем администратора
        $this->actingAs($this->adminUser);
    }
    /** @test */
    public function it_can_create_a_vacancy()
    {
        $response = $this->post(route('admin.vacancies.store'), [
            'title' => 'Test Vacancy',
            'description' => 'Description of test vacancy',
            'department' => 'IT',
            'location' => 'Remote',
            'type' => 'Full-time',
            'salary' => 50000,
            'contact_email' => 'test@example.com',
            'contact_phone' => '1234567890',
        ]);

        $response->assertRedirect(route('admin.vacancies.index'));
        $this->assertDatabaseHas('vacancies', [
            'title' => 'Test Vacancy',
        ]);
    }

    /** @test */
    public function it_can_update_a_vacancy()
    {
        $vacancy = Vacancies::create([
            'title' => 'Old Title',
            'description' => 'Old description',
            'department' => 'IT',
            'location' => 'Remote',
            'type' => 'Full-time',
            'salary' => 50000,
            'contact_email' => 'test@example.com',
            'contact_phone' => '1234567890',
        ]);

        $response = $this->put(route('admin.vacancies.update', $vacancy->vacancy_id), [
            'title' => 'New Title',
            'description' => $vacancy->description,
            'department' => $vacancy->department,
            'location' => $vacancy->location,
            'type' => $vacancy->type,
            'salary' => 60000,
            'contact_email' => $vacancy->contact_email,
            'contact_phone' => $vacancy->contact_phone,
        ]);

        $response->assertRedirect(route('admin.vacancies.index'));
        $this->assertDatabaseHas('vacancies', [
            'title' => 'New Title',
        ]);
    }


    /** @test */
    public function it_can_display_the_vacancies_index_page()
    {
        $response = $this->get(route('admin.vacancies.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.vacancies.index');
    }
}
