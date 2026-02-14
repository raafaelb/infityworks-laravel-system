<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Enrollment;
use App\Models\Subject;
use Carbon\Carbon;

class ReportService
{
    public function dashboard(): array
    {
        $courses = Course::with(['students','subjects'])->get();

        $report = [];

        foreach ($courses as $course) {

            $ages = $course->students
                ->filter(fn ($student) => $student->birth_date)
                ->map(fn ($student) => Carbon::parse($student->birth_date)->age);

            $report[] = [
                'course'        => $course->title,
                'average_age'   => $ages->isEmpty() ? null : round($ages->avg(), 1),
                'youngest'      => $ages->isEmpty() ? null : $ages->min(),
                'oldest'        => $ages->isEmpty() ? null : $ages->max(),
                'students_count'=> $course->students->count(),
                'subjects_count'=> $course->subjects->count(),
            ];
        }

        $allAges = Student::whereNotNull('birth_date')
            ->get()
            ->map(fn ($s) => Carbon::parse($s->birth_date)->age);

        return [
            'summary' => [
                'courses'      => Course::count(),
                'students'     => Student::count(),
                'teachers'     => Teacher::count(),
                'enrollments'  => Enrollment::count(),
                'average_age'  => $allAges->isEmpty() ? null : round($allAges->avg(), 1),
            ],
            'courses' => $report,
        ];
    }
}
