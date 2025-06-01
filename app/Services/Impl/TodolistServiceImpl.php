<?php

namespace App\Services\Impl;

use App\Models\Todo;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        Todo::create([
            'id' => $id,
            'todo' => $todo
        ]);
    }

    public function getTodo(): array
    {
        return Todo::get()->toArray();
    }

    public function removeTodo(string $todoId)
    {
        $todo = Todo::find($todoId);
        $todo->delete();
    }
}