<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KanbanTaskTag extends Pivot
{
    protected $table = 'kanban_task_tag';
}
