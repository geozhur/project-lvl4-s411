<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function creater()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
