<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vacancies;

class CorrectDisplayOfDateTest extends TestCase
{
    public function test_correct_display_of_date(): void
    {
        $vacancy = new Vacancies();
        $vacancy->published_at = '2023-05-15 00:00:00';

        $this->assertEquals('15.05.2023', $vacancy->getFormattedTime());
    }
}

