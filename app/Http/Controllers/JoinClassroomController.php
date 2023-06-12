<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinClassroomController extends Controller
{
    public function create(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.join', [
            'classroom' => $classroom,
        ]);
    }

    public function store(Request $request, string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $code = $request->post('code');
        $user_id = Auth::id();
        if ($code == $classroom->code) {

            $exists = $classroom->users()->wherePivot('user_id', '=', $user_id)->exists();
            if (!$exists) {
                $classroom->users()->attach($user_id, [
                    'role' => 'student',
                ]);

                return redirect()->route('classrooms.show', $classroom->id);
            }
        }

        return redirect()->route('classrooms.join', $classroom->id)
            ->with('error', __('Could not join the classroom. Something wrong!'));
    }

    public function destroy(Request $request, string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $user_id = $request->input('user_id');
        $classroom->users()->detach($user_id);

        return redirect()->route('classrooms.people', $classroom->id)
            ->with('success', __('User removed!'));
    }
}
