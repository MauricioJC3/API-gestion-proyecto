<?php

namespace App\Repositories\Kamban;

use App\Models\KanbanTag;
use App\Interfaces\Kamban\KanbanTagRepositoryInterface;

class KanbanTagRepository implements KanbanTagRepositoryInterface
{
    public function all()
    {
        return KanbanTag::all();
    }

    public function findById(int $id)
    {
        return KanbanTag::findOrFail($id);
    }

    public function create(array $data)
    {
        return KanbanTag::create($data);
    }

    public function update(int $id, array $data)
    {
        $tag = KanbanTag::findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    public function delete(int $id)
    {
        $tag = KanbanTag::findOrFail($id);
        return $tag->delete();
    }
}

