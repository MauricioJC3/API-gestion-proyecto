<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KanbanTaskUser extends Pivot
{
    protected $table = 'kanban_task_user';
}
