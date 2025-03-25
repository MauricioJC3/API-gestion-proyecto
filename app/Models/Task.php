<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'name', 'description', 'due_date', 'completed'];

    protected $casts = [
        'due_date' => 'date',
        'completed' => 'boolean',
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