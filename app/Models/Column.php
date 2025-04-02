<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = ['board_id', 'name', 'position'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(KanbanTask::class, 'column_id');
    }

    public function tags()
    {
        return $this->hasMany(KanbanTag::class, 'board_id', 'board_id');
    }


}
