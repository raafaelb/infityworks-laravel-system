<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.courses.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('courses', CourseController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('students', StudentController::class);
        Route::resource('enrollments', EnrollmentController::class);

        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    });

Route::middleware(['auth', 'student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [StudentProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [StudentProfileController::class, 'update'])
            ->name('profile.update');
    });

require __DIR__.'/auth.php';

Route::get('/redirect', function () {

    $user = auth()->user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.courses.index');
    }

    if ($user->isStudent()) {
        return redirect()->route('student.dashboard');
    }

    abort(403);

})->middleware('auth')->name('redirect');
