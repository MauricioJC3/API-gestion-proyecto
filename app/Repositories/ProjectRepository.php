<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects($userId)
    {
        return Project::where('user_id', $userId)->get();
    }

    public function getProjectById($projectId, $userId)
    {
        return Project::where('id', $projectId)
            ->where('user_id', $userId)
            ->firstOrFail();
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function updateProject($projectId, array $data)
    {
        $project = Project::findOrFail($projectId);
        $project->update($data);
        return $project;
    }

    public function deleteProject($projectId, $userId)
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', $userId)
            ->firstOrFail();
        return $project->delete();
    }
}