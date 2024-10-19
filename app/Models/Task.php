<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['titel', 'beschrijving', 'status', 'vervaldatum', 'prioriteit'];

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}
