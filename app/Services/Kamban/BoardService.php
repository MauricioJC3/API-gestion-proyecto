<?php

namespace App\Services\Kamban;

use App\Interfaces\Kamban\BoardRepositoryInterface;
use App\Models\Board;

class BoardService
{
    protected $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function getAllBoards()
    {
        return $this->boardRepository->getAll();
    }
    
    public function getAllBoardsForUser($userId)
    {
        return $this->boardRepository->getAllForUser($userId);
    }

    public function getBoardById($id)
    {
        return $this->boardRepository->getById($id);
    }
    
    public function getBoardByIdForUser($id, $userId)
    {
        return $this->boardRepository->getByIdForUser($id, $userId);
    }

    public function createBoard(array $data)
    {
        return $this->boardRepository->create($data);
    }

    public function updateBoard($id, array $data)
    {
        $board = $this->boardRepository->getById($id);
        return $this->boardRepository->update($board, $data);
    }
    
    public function updateBoardForUser($id, $userId, array $data)
    {
        $board = $this->boardRepository->getByIdForUser($id, $userId);
        return $this->boardRepository->update($board, $data);
    }

    public function deleteBoard($id)
    {
        $board = $this->boardRepository->getById($id);
        return $this->boardRepository->delete($board);
    }
    
    public function deleteBoardForUser($id, $userId)
    {
        $board = $this->boardRepository->getByIdForUser($id, $userId);
        return $this->boardRepository->delete($board);
    }
}