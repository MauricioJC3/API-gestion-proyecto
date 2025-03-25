<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
    public function getAllTagsByProject($projectId, $userId);
    public function getTagById($tagId, $userId);
    public function createTag(array $data);
    public function updateTag($tagId, array $data);
    public function deleteTag($tagId, $userId);
}