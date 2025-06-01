<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('DELETE FROM users');

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $this->assertTrue($this->userService->login('hans@gmail.com', 'rahasia'));
    }

    public function testLoginUserNotFound()
    {
        $this->assertFalse($this->userService->login('wahyu', 'rahasia'));
    }

    public function testLoginWrongPassword()
    {
        $this->assertFalse($this->userService->login('farhan', 'salah'));
    }
}
