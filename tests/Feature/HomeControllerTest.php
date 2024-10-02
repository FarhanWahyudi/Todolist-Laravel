<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testQuest()
    {
        $this->get('/')
            ->assertRedirect('/login');
    }
    
    public function testMember()
    {
        $this->withSession([
            'user' => 'farhan'
        ])->get('/')
            ->assertRedirect('/todolist');
    }
}
