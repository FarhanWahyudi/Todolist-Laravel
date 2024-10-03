<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    private TodoListService $todoListService;

    public function __construct(TodoListService $todoListService) {
        $this->todoListService = $todoListService;
    }
    
    public function todoList(Request $request): Response
    {
        $todolist = $this->todoListService->getTodoList();

        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $todolist
        ]);
    }

    public function addTodo(Request $request): Response|RedirectResponse
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            $todolist = $this->todoListService->getTodoList();
            return response()->view('todolist.todolist', [
                'title' => 'Todolist',
                'todolist' => $todolist,
                'error' => 'Todo is required'
            ]);
        }
        
        $this->todoListService->saveTodo(uniqid() ,$todo);
        return redirect()->action([TodoListController::class, 'todoList']);
    }

    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todoListService->removeTodo($todoId);
        return redirect()->action([TodoListController::class, 'todoList']);
    }
}
