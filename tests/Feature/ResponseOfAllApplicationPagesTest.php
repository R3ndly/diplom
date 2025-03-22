<?php
namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseOfAllApplicationPagesTest extends TestCase
{
    public function test_successful_response_home_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_successful_response_contact_page(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_successful_response_about_page(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function test_successful_response_login_page(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_successful_response_register_page(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
