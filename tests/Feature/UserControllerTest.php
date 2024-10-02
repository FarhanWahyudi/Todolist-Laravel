<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'farhan',
            'password' => '12345'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'farhan');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('User or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])
            ->assertSeeText('User or password is wrong');
    }
}
