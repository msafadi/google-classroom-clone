<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::getClassroomsForUser(Auth::id());

        return view('classrooms.index', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClassroomRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['code'] = Str::random(8);

        DB::beginTransaction();
        try {
            $classroom = Classroom::create($data);
            $classroom->teachers()->attach(Auth::id(), [
                'role' => 'teacher',
            ]);

            DB::commit();

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('classrooms.index')
            ->with('success', __('Classroom created!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.show', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateClassroomRequest $request, string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->validated());
        return redirect()->route('classrooms.index')
            ->with('success', __('Classroom updated!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('classrooms.index')
            ->with('success', __('Classroom deleted!'));
    }

    public function people(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $users = $classroom->users; // Collection
        
        return view('classrooms.people', [
            'classroom' => $classroom,
            'users' => $users,
        ]);
    }
}
