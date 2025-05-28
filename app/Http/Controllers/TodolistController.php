<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService) {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request) {
        $todolist = $this->todolistService->getTodo();

        return response()->view('todolist.todolist', [
            'title' => 'TodoList',
            'todolist' => $todolist
        ]);
    }

    public function addTodo(Request $request) {

    }

    public function removeTodo(Request $request) {

    }
}
