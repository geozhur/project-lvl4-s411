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
        'assigned_to_id',
        "creator_id"
    ];

    public function creator()
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

    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }

    public function syncTags($tagsNames)
    {
        $tagsNamesForAdd = [];
        if ($tagsNames) {
            foreach ($tagsNames as $tagName) {
                $newTag = \App\Tag::firstOrCreate(['name' => $tagName]);
                $newTag->save();
                $tagsNamesForAdd[] = $newTag->id;
            }
        }
        $this->tag()->sync($tagsNamesForAdd);
    }
}
