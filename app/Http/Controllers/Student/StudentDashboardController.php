<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentDashboardController extends Controller
{
    public function __construct(
        private StudentService $studentService
    ) {}

    public function index()
    {
        $student = $this->studentService
            ->getDashboardData(auth()->user());

        return view('student.dashboard', compact('student'));
    }


}
