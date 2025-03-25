<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasksByTag($tagId, $userId)
    {
        return Task::whereHas('tag.project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('tag_id', $tagId)->get();
    }

    public function getTaskById($taskId, $userId)
    {
        return Task::whereHas('tag.project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('id', $taskId)->firstOrFail();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask($taskId, array $data)
    {
        $task = Task::findOrFail($taskId);
        $task->update($data);
        return $task;
    }

    public function deleteTask($taskId, $userId)
    {
        $task = Task::whereHas('tag.project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('id', $taskId)->firstOrFail();
        
        return $task->delete();
    }

    public function completeTask($taskId, $userId)
    {
        $task = Task::whereHas('tag.project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('id', $taskId)->firstOrFail();
        
        $task->completed = true;
        $task->save();
        
        return $task;
    }

    public function assignTaskToUser($taskId, $userId)
    {
        $task = Task::findOrFail($taskId);
        $task->users()->syncWithoutDetaching([$userId]);
        return $task;
    }
}