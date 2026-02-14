<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Student;
use App\Services\EnrollmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class EnrollmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_be_enrolled_twice()
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();

        $service = new EnrollmentService();

        $service->enroll($student, $course);

        $this->expectException(ValidationException::class);

        $service->enroll($student, $course);
    }
}
