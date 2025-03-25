<?php

namespace App\Services;

use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;

class TaskService
{
    protected $taskRepository;
    protected $tagRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        TagRepositoryInterface $tagRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->tagRepository = $tagRepository;
    }

    public function getAllTasksByTag($tagId, $userId)
    {
        // Verificar que la etiqueta pertenece al usuario
        $this->tagRepository->getTagById($tagId, $userId);
        return $this->taskRepository->getAllTasksByTag($tagId, $userId);
    }

    public function getTaskById($taskId, $userId)
    {
        return $this->taskRepository->getTaskById($taskId, $userId);
    }

    public function createTask(array $data, $userId)
    {
        // Verificar que la etiqueta pertenece al usuario
        $this->tagRepository->getTagById($data['tag_id'], $userId);
        return $this->taskRepository->createTask($data);
    }

    public function updateTask($taskId, array $data, $userId)
    {
        // Verificar que la tarea pertenece al usuario
        $this->taskRepository->getTaskById($taskId, $userId);
        return $this->taskRepository->updateTask($taskId, $data);
    }

    public function deleteTask($taskId, $userId)
    {
        return $this->taskRepository->deleteTask($taskId, $userId);
    }

    public function completeTask($taskId, $userId)
    {
        return $this->taskRepository->completeTask($taskId, $userId);
    }

    public function assignTaskToUser($taskId, $userId)
    {
        // Verificar que la tarea pertenece al usuario
        $this->taskRepository->getTaskById($taskId, $userId);
        return $this->taskRepository->assignTaskToUser($taskId, $userId);
    }
}