<?php

namespace App\Services;

use App\Interfaces\ProjectRepositoryInterface;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects($userId)
    {
        return $this->projectRepository->getAllProjects($userId);
    }

    public function getProjectById($projectId, $userId)
    {
        return $this->projectRepository->getProjectById($projectId, $userId);
    }

    public function createProject(array $data, $userId)
    {
        $data['user_id'] = $userId;
        return $this->projectRepository->createProject($data);
    }

    public function updateProject($projectId, array $data, $userId)
    {
        // Verificar que el proyecto pertenece al usuario
        $this->projectRepository->getProjectById($projectId, $userId);
        return $this->projectRepository->updateProject($projectId, $data);
    }

    public function deleteProject($projectId, $userId)
    {
        return $this->projectRepository->deleteProject($projectId, $userId);
    }
}