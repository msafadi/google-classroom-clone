<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        
        $assignments = $classroom->assignments;
        return view('assignments.index', [
            'classroom' => $classroom,
            'assignments' => $assignments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classroom $classroom)
    {
        return view('assignments.create', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request, Classroom $classroom)
    {
        $data = $request->validated();
        $data['classroom_id'] = $classroom->id;
        $assignment = Assignment::create($data);
        
        event('assignment-created', $assignment);

        return redirect()->route('assignments.index', $classroom->id)
            ->with('success', __('Assignment created!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Assignment $assignment)
    {
        return view('assignments.show', [
            'assignment' => $assignment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom, Assignment $assignment)
    {
        return view('assignments.edit', [
            'assignment' => $assignment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignment->update( $request->validated() );

        return redirect()->route('assignments.index', $assignment->classroom_id)
            ->with('success', __('Assignment updated!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, Assignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('assignments.index', $assignment->classroom_id)
            ->with('success', __('Assignment deleted!'));
    }
}
