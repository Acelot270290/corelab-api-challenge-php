<?php

namespace App\Actions;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskAction
{
    public function getAllTasks(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('favorite')) {
            $tasks->where('is_favorite', $request->favorite);
        }

        if ($request->has('color')) {
            $tasks->where('color', $request->color);
        }

        return $tasks->orderBy('is_favorite', 'desc')->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        Task::destroy($id);
    }

    public function toggleFavorite($id)
    {
        $task = Task::findOrFail($id);
        $task->is_favorite = !$task->is_favorite;
        $task->save();
        return $task;
    }

    public function updateTaskColor($id, $color)
    {
        $task = Task::findOrFail($id);
        $task->color = $color;
        $task->save();
        return $task;
    }
}
