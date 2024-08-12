<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Actions\TaskAction;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskAction;

    public function __construct(TaskAction $taskAction)
    {
        $this->taskAction = $taskAction;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskAction->getAllTasks($request);
        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = $this->taskAction->createTask($request->validated());
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = $this->taskAction->getTaskById($id);
        return response()->json($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskAction->updateTask($id, $request->validated());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $this->taskAction->deleteTask($id);
        return response()->json(null, 204);
    }

    public function toggleFavorite($id)
    {
        $task = $this->taskAction->toggleFavorite($id);
        return response()->json($task);
    }

    public function updateColor(Request $request, $id)
    {
        $task = $this->taskAction->updateTaskColor($id, $request->color);
        return response()->json($task);
    }
}
