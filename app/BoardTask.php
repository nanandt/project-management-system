<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardTask extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'boards_id', 'task_name', 'task_description', 'due_date', 'start_date', 'status_task', 'tags', 'tags_color'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class, 'boards_id', 'id');
    }

    public function task_member()
    {
        return $this->hasMany(TaskMember::class, 'board_tasks_id', 'id');
    }

    public function task_file()
    {
        return $this->hasMany(TaskFile::class, 'board_tasks_id', 'id');
    }

    public function sub_task()
    {
        return $this->hasMany(SubTask::class, 'board_tasks_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(CommentTask::class, 'board_tasks_id', 'id');
    }
}
