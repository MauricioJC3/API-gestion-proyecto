<?php


namespace App\Services\Kamban;

use App\Interfaces\Kamban\BoardRepositoryInterface;

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

    public function getBoardById($id)
    {
        return $this->boardRepository->getById($id);
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

    public function deleteBoard($id)
    {
        $board = $this->boardRepository->getById($id);
        return $this->boardRepository->delete($board);
    }
}
