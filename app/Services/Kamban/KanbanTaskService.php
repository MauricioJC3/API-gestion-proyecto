<?php

namespace App\Services\Kamban;

use App\Interfaces\Kamban\KanbanTaskRepositoryInterface;

class KanbanTaskService
{
    protected $taskRepository;

    public function __construct(KanbanTaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->all();
    }

    public function getTaskById(int $id)
    {
        return $this->taskRepository->findById($id);
    }

    public function createTask(array $data)
    {
        // Si no se pasa la fecha de inicio, se usa la fecha actual
        if (empty($data['start_date'])) {
            $data['start_date'] = now();  // Fecha actual como fecha de inicio por defecto
        }
        return $this->taskRepository->create($data);
    }

    public function updateTask(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function deleteTask(int $id)
    {
        return $this->taskRepository->delete($id);
    }
}
