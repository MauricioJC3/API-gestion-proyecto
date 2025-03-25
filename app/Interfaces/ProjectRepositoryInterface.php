<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAllProjects($userId);
    public function getProjectById($projectId, $userId);
    public function createProject(array $data);
    public function updateProject($projectId, array $data);
    public function deleteProject($projectId, $userId);
}