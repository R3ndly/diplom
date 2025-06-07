<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\ApiAuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class AuthTest extends TestCase
{
    //use RefreshDatabase;

    public function test_login(): void
    {
        $mockUser = Mockery::mock(User::class)->makePartial();
        $mockUser->shouldReceive('createToken')->once()->with('api-token')->andReturn((object) [
            'plainTextToken' => 'fake-token'
        ]);

        $mockUser->shouldReceive('toArray')->andReturn([
            'email' => 'test@test.com'
        ]);

        Auth::shouldReceive('attempt')->once()->with([
            'email' => 'test@test.com',
            'password' => '123456'
        ])->andReturn(true);

        Auth::shouldReceive('user')->once()->andReturn($mockUser);

        $request = new Request([
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $controller = new ApiAuthController();
        $response = $controller->login($request);

        $this->assertEquals(200, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals('fake-token', $responseData['token']);
        $this->assertEquals('test@test.com', $responseData['user']['email']);
    }

    public function test_register(): void
    {
        $request = new Request([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => 'Q1qqqqqq',
            'password_confirmation' => 'Q1qqqqqq',
        ]);

        $controller = new ApiAuthController();
        $response = $controller->register($request);

        $this->assertEquals(201, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertTrue($responseData['success']);
        $this->assertEquals('test', $responseData['user']['name']);
        $this->assertEquals('test@mail.ru', $responseData['user']['email']);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertNotEmpty($responseData['token']);
    }

    public function test_logout(): void
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('Q1qqqqqq')
        ]);

        Sanctum::actingAs($user);

        $this->assertAuthenticatedAs($user);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->post('/api/logout', [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Logged out successfully'
        ]);

        $this->assertEmpty($user->fresh()->tokens);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
