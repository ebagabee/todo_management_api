<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'priority', 'estimated_hours',
        'actual_hours', 'start_date', 'due_date', 'completed_at', 'project_id'
    ];

    protected $dates = ['start_date', 'due_date', 'completed_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
