<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id', 'topic_id', 'title', 'description',
        'points', 'due',
    ];

    protected $casts = [
        'due' => 'datetime',
        'topic_id' => 'int',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
