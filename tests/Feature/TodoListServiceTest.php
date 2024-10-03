<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodoListServiceTest extends TestCase
{
    private TodoListService $todoListService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodoListService::class);
    }

    public function testTodoListNotNull()
    {
        $this->assertNotNull($this->todoListService);
    }

    public function testSaveTodo()
    {
        $this->todoListService->saveTodo('1', 'farhan');

        $todolist = Session::get('todolist');
        foreach ($todolist as $value) {
            $this->assertEquals('1', $value['id']);
            $this->assertEquals('farhan', $value['todo']);
        }
    }

    public function testGetTodoListEmpty() {
        $this->assertEquals([], $this->todoListService->getTodoList());
    }

    public function testGetTodoListNotEmpty() {
        $expected = [
            [
                'id' => '1',
                'todo' => 'farhan'
            ],
            [
                'id' => '2',
                'todo' => 'wahyu'
            ],
        ];

        $this->todoListService->saveTodo('1', 'farhan');
        $this->todoListService->saveTodo('2', 'wahyu');

        $this->assertEquals($expected, $this->todoListService->getTodoList());
    }

    public function testRemoveTodo()
    {
        $this->todoListService->saveTodo('1', 'farhan');
        $this->todoListService->saveTodo('2', 'wahyu');

        $this->assertEquals(2, sizeof($this->todoListService->getTodoList()));

        $this->todoListService->removeTodo('3');

        $this->assertEquals(2, sizeof($this->todoListService->getTodoList()));

        $this->todoListService->removeTodo('1');

        $this->assertEquals(1, sizeof($this->todoListService->getTodoList()));

        $this->todoListService->removeTodo('1');

        $this->assertEquals(1, sizeof($this->todoListService->getTodoList()));

    }
}
