<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function task()
    {
        return $this->belongsToMany(Task::class);
    }
}
