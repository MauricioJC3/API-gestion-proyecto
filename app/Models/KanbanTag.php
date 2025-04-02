<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_id', 'name', 'color'
    ];

    public function board()
    {
        return $this->belongsTo(board::class);
    }

    public function tags()
    {
        return $this->hasMany(KanbanTag::class, 'column_id');
    }


    public function tasks()
    {
        return $this->belongsToMany(KanbanTask::class, 'kanban_task_tag');
    }
}
