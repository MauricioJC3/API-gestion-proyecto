<?php

namespace App\Services\Kamban;

use App\Interfaces\Kamban\KanbanTagRepositoryInterface;

class KanbanTagService
{
    protected $tagRepository;

    public function __construct(KanbanTagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->all();
    }

    public function getTagById(int $id)
    {
        return $this->tagRepository->findById($id);
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag(int $id, array $data)
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag(int $id)
    {
        return $this->tagRepository->delete($id);
    }
}
