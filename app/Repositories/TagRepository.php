<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use App\Models\Project;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTagsByProject($projectId, $userId)
    {
        // Verificar que el proyecto pertenece al usuario
        $project = Project::where('id', $projectId)
            ->where('user_id', $userId)
            ->firstOrFail();
            
        return Tag::where('project_id', $projectId)->get();
    }

    public function getTagById($tagId, $userId)
    {
        return Tag::whereHas('project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('id', $tagId)->firstOrFail();
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function updateTag($tagId, array $data)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->update($data);
        return $tag;
    }

    public function deleteTag($tagId, $userId)
    {
        $tag = Tag::whereHas('project', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('id', $tagId)->firstOrFail();
        
        return $tag->delete();
    }
}