<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function taskCreator()
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function taskAssignedTo()
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    public function getName()
    {
        return $this->name;
    }

    public function hasCreator()
    {
        return $this->taskCreator()->exists();
    }

    public function hasAssignedTo()
    {
        return $this->taskAssignedTo()->exists();
    }
}
