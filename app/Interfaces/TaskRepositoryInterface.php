<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTasksByTag($tagId, $userId);
    public function getTaskById($taskId, $userId);
    public function createTask(array $data);
    public function updateTask($taskId, array $data);
    public function deleteTask($taskId, $userId);
    public function completeTask($taskId, $userId);
    public function assignTaskToUser($taskId, $userId);
}