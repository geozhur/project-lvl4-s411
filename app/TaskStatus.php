<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    const DEFAULT_ID = 1;

    protected $fillable = [
        'name',
    ];

    public function task()
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    public function hasTask()
    {
        return $this->task()->exists();
    }
}
