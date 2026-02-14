<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Validation\ValidationException;

class EnrollmentService
{
    public function list()
    {
        return Enrollment::with(['student','course'])
            ->orderBy('id','desc')
            ->paginate(10);
    }

    public function enroll(Student $student, Course $course): Enrollment
    {
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            throw ValidationException::withMessages([
                'course_id' => 'Aluno já matriculado neste curso.'
            ]);
        }

        return Enrollment::create([
            'student_id' => $student->id,
            'course_id'  => $course->id,
        ]);
    }

    public function show(Enrollment $enrollment): Enrollment
    {
        return $enrollment->load(['student','course']);
    }

    public function update(Enrollment $enrollment, array $data): Enrollment
    {
        $exists = Enrollment::where('student_id', $data['student_id'])
            ->where('course_id', $data['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'course_id' => 'Aluno já matriculado neste curso.'
            ]);
        }

        $enrollment->update($data);

        return $enrollment;
    }


    public function remove(Enrollment $enrollment): void
    {
        $enrollment->delete();
    }
}
