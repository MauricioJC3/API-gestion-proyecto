<?php

namespace App\Services;

use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;

class TagService
{
    protected $tagRepository;
    protected $projectRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository,
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->projectRepository = $projectRepository;
    }

    public function getAllTagsByProject($projectId, $userId)
    {
        return $this->tagRepository->getAllTagsByProject($projectId, $userId);
    }

    public function getTagById($tagId, $userId)
    {
        return $this->tagRepository->getTagById($tagId, $userId);
    }

    public function createTag(array $data, $userId)
    {
        // Verificar que el proyecto pertenece al usuario
        $this->projectRepository->getProjectById($data['project_id'], $userId);
        return $this->tagRepository->createTag($data);
    }

    public function updateTag($tagId, array $data, $userId)
    {
        // Verificar que la etiqueta pertenece al usuario
        $this->tagRepository->getTagById($tagId, $userId);
        return $this->tagRepository->updateTag($tagId, $data);
    }

    public function deleteTag($tagId, $userId)
    {
        return $this->tagRepository->deleteTag($tagId, $userId);
    }
}