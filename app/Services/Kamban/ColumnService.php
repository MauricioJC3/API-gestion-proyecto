<?php


namespace App\Services\Kamban;

use App\Interfaces\Kamban\ColumnRepositoryInterface;

class ColumnService
{
    protected $columnRepository;

    public function __construct(ColumnRepositoryInterface $columnRepository)
    {
        $this->columnRepository = $columnRepository;
    }

    public function getAllColumns()
    {
        return $this->columnRepository->getAll();
    }

    public function getColumnById($id)
    {
        return $this->columnRepository->getById($id);
    }

    public function createColumn(array $data)
    {
        return $this->columnRepository->create($data);
    }

    public function updateColumn($id, array $data)
    {
        $column = $this->columnRepository->getById($id);
        return $this->columnRepository->update($column, $data);
    }

    public function deleteColumn($id)
    {
        $column = $this->columnRepository->getById($id);
        return $this->columnRepository->delete($column);
    }
}
