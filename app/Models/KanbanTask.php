<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'column_id', 'title', 'description', 'position', 'completed', 'start_date', 'due_date'
    ];

    protected $casts = [
        'completed'  => 'boolean',
        'start_date' => 'datetime:Y-m-d H:i:s', // 🔹 Se castea como fecha y hora
        'due_date' => 'datetime:Y-m-d H:i:s', // 🔹 También la fecha de entrega
    ];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    public function tags()
    {
        return $this->belongsToMany(KanbanTag::class, 'kanban_task_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'kanban_task_user');
    }
}
