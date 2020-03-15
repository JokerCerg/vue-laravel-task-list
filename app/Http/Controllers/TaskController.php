<?php

namespace App\Http\Controllers;

use App\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $task = new Task;

        $task->id = $request->id;

        $task->title = $request->title;

        $task->save();

        return Task::all();
    }
}
