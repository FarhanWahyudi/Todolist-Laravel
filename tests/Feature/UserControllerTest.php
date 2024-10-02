<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPageForMember()
    {
        $this->withSession([
            'user' => 'farhan'
        ])->get('/login')
            ->assertRedirect('/');
    }
    
    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'farhan',
            'password' => '12345'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'farhan');
    }
    
    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            'user' => 'farhan'
        ])->post('/login', [
            'user' => 'farhan',
            'password' => '12345'
        ])->assertRedirect('/');
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

    public function testLogOut()
    {
        $this->withSession([
            'user' => 'farhan'
        ])->post('/logout')
            ->assertSessionMissing('user')
            ->assertRedirect('/');
    }

    public function testLogOutForQuest()
    {
        $this->post('/logout')
            ->assertRedirect('/login');
    }
}
