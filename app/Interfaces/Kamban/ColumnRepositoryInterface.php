<?php

namespace App\Interfaces\Kamban;

use App\Models\Column;

interface ColumnRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(Column $column, array $data);
    public function delete(Column $column);
}
