<?php

namespace App;

use Auth;

class TaskFilter extends QueryFilter
{
    public function status($value)
    {
        $this->builder->where('status_id', '=', $value);
    }

    public function tag($value)
    {
        $this->builder->whereHas('tag', function ($q) use ($value) {
            $q->where('name', '=', $value);
        });
    }

    public function assignedto($value)
    {
        $this->builder->where('assigned_to_id', '=', $value);
    }

    public function mytasks($value)
    {
        $this->builder->where('creator_id', '=', Auth::user()->id);
    }
}
