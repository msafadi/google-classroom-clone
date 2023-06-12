<?php

use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\ProfileController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('classrooms/{classroom}/stream', [ClassroomsController::class, 'show'])
        ->name('classrooms.stream');
    Route::get('classrooms/{classroom}/classwork', [ClassroomsController::class, 'classwork'])
        ->name('classrooms.classwork');
    Route::get('classrooms/{classroom}/people', [ClassroomsController::class, 'people'])
        ->name('classrooms.people');
    Route::delete('classrooms/{classroom}/people', [JoinClassroomController::class, 'destroy'])
        ->name('classrooms.users.remove');

    Route::resource('classrooms', ClassroomsController::class);
    Route::resource('classrooms.assignments', AssignmentsController::class)
        ->shallow(false);
    
    Route::get('join/{classroom}', [JoinClassroomController::class, 'create'])
        ->name('classrooms.join');
    Route::post('join/{classroom}', [JoinClassroomController::class, 'store']);
    
});

require __DIR__.'/auth.php';
