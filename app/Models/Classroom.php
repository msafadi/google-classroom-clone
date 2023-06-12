<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'section', 'subject', 'room', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teachers()
    {

    }

    public function studnets()
    {

    }

    public function assignments()
    {

    }

    public function materials()
    {

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
        return self::where('user_id' , '=', $user_id)
            ->orWhere(
                DB::raw('EXISTS (
                    SELECT 1 FROM classroom_user WHERE user_id = ? AND classroom_id = classrooms.id
                )', 
                [$user_id]
            ))
            ->paginate();
    }
}
