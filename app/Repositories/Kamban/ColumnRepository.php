<?php


namespace App\Repositories\Kamban;


use App\Interfaces\Kamban\ColumnRepositoryInterface;
use App\Models\Column;

class ColumnRepository implements ColumnRepositoryInterface
{
    public function getAll()
    {
        return Column::all();
    }

    public function getById($id)
    {
        return Column::findOrFail($id);
    }

    public function create(array $data)
    {
        return Column::create($data);
    }

    public function update(Column $column, array $data)
    {
        $column->update($data);
        return $column;
    }

    public function delete(Column $column)
    {
        return $column->delete();
    }
}
