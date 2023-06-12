<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'section', 'subject', 'room', 'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope('allowed', function($query) {
            $user_id = Auth::id();
            if ($user_id) {
                $query->where('user_id' , '=', $user_id)
                    ->orWhereRaw('EXISTS (
                            SELECT 1 FROM classroom_user WHERE user_id = ? AND classroom_id = classrooms.id
                        )', 
                        [$user_id]
                    );
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'classroom_user', 'classroom_id', 'user_id')
            ->withPivot(['role'])
            ->withTimestamps();
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role', '=', 'teacher');
    }

    public function studnets()
    {
        return $this->users()->wherePivot('role', '=', 'student');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public static function getClassroomsForUser($user_id)
    {
                /*
        SELECT * FROM classrooms
        WHERE user_id = ?
        OR id IN (
            SELECT classroom_id FROM classroom_user WHERE user_id = ?
        )
        OR EXISTS (
            SELECT 1 FROM classroom_user WHERE user_id = ? AND classroom_id = classrooms.id
        )
        */
        return self::paginate();
    }
}
