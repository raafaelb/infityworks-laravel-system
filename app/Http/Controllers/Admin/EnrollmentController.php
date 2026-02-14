<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Http\Requests\StoreEnrollmentRequest;

class EnrollmentController extends Controller
{
    public function __construct(
        protected EnrollmentService $service
    ) {}

    public function index()
    {
        $enrollments = $this->service->list();

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $courses  = Course::all();

        return view('admin.enrollments.create', compact('students','courses'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $student = Student::findOrFail($request->student_id);
        $course  = Course::findOrFail($request->course_id);

        try {

            $this->service->enroll($student, $course);

            return redirect()
                ->route('admin.enrollments.index')
                ->with('success', 'Matrícula realizada com sucesso.');

        } catch (ValidationException $e) {

            return back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses  = Course::all();

        return view('admin.enrollments.edit', compact('enrollment','students','courses'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $this->service->update($enrollment, $request->validated());

        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Matrícula atualizada com sucesso.');
    }


    public function show(Enrollment $enrollment)
    {
        $enrollment = $this->service->show($enrollment);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $this->service->remove($enrollment);

        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Matrícula removida.');
    }
}
