<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'name', 'description', 'completed', 'priority', 'start_date', 'due_date'];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'completed' => 'boolean',
        'priority' => 'string'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}