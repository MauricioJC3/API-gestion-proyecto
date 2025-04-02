<?php

namespace App\Repositories\Kamban;

use App\Models\KanbanTask;
use App\Interfaces\Kamban\KanbanTaskRepositoryInterface;

class KanbanTaskRepository implements KanbanTaskRepositoryInterface
{
    public function all()
    {
        return KanbanTask::all();
    }

    public function findById(int $id)
    {
        return KanbanTask::findOrFail($id);
    }

    public function create(array $data)
    {
        return KanbanTask::create($data);
    }

    public function update(int $id, array $data)
    {
        $task = KanbanTask::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete(int $id)
    {
        $task = KanbanTask::findOrFail($id);
        return $task->delete();
    }
}
