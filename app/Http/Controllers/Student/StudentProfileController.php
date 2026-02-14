<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\StudentService;
use App\Http\Requests\UpdateStudentProfileRequest;

class StudentProfileController extends Controller
{
    public function __construct(
        private StudentService $studentService
    ) {}

    public function edit()
    {
        $student = auth()->user()->student;

        return view('student.profile', compact('student'));
    }

    public function update(UpdateStudentProfileRequest $request)
    {
        $student = auth()->user()->student;

        $this->studentService->update($student, $request->validated());

        return back()->with('success', 'Dados atualizados com sucesso.');
    }
}
