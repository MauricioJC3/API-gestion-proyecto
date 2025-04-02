<?php

namespace App\Interfaces\Kamban;

use App\Models\KanbanTag;

interface KanbanTagRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}