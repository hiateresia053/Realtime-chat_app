<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_seen' => 'datetime',
        ];
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function getIsOnlineAttribute()
    {
        return $this->last_seen &&
               $this->last_seen->gt(now()->subMinutes(2));
    }
}