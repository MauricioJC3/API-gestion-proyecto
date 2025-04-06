<?php

namespace App\Repositories\Kamban;

use App\Interfaces\Kamban\BoardRepositoryInterface;
use App\Models\Board;

class BoardRepository implements BoardRepositoryInterface
{
    public function getAll()
    {
        return Board::all();
    }
    
    public function getAllForUser($userId)
    {
        return Board::where('user_id', $userId)->get();
    }

    public function getById($id)
    {
        return Board::with(['columns.tasks', 'columns.tags'])->findOrFail($id);
    }
    
    public function getByIdForUser($id, $userId)
    {
        return Board::with(['columns.tasks', 'columns.tags'])
            ->where('user_id', $userId)
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Board::create($data);
    }

    public function update(Board $board, array $data)
    {
        $board->update($data);
        return $board;
    }

    public function delete(Board $board)
    {
        return $board->delete();
    }
}