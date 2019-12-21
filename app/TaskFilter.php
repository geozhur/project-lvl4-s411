<?php

namespace App;

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
    /*
    public function birthday($value)
    {
        if (! $value) return;
        $this->builder->whereHas('info', function ($query) use ($value) {
            $query->where('birthday', '>', $value);
        });
    }
    public function gender($value)
    {
        $this->builder->where('gender', $value);
    }*/
}
