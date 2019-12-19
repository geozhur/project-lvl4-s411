<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'assignedto_id'
    ];

    public static $createRules = [
        'name'          => 'required|string|min:3|max:255',
        'description'   => 'string|max:1024',
        'status'        => 'required|exists:task_statuses,id',
        'creator'       => 'required|exists:users,id',
        'assignedTo'    => 'required|exists:users,id',
        'tags'          => 'required|string|max:255',
    ];

    public static $updateRules = [

    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function assignedto()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }
}
