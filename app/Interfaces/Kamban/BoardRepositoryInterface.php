<?php

namespace App\Interfaces\Kamban;

use App\Models\Board;

interface BoardRepositoryInterface
{
    public function getAll();
    
    public function getAllForUser($userId);
    
    public function getById($id);
    
    public function getByIdForUser($id, $userId);
    
    public function create(array $data);
    
    public function update(Board $board, array $data);
    
    public function delete(Board $board);
}