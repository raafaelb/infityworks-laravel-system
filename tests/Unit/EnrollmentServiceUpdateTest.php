<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Services\EnrollmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class EnrollmentServiceUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_prevents_duplicate_enrollment()
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();

        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);

        $enrollment = Enrollment::create([
            'student_id' => $student->id,
            'course_id' => Course::factory()->create()->id,
        ]);

        $service = new EnrollmentService();

        $this->expectException(ValidationException::class);

        $service->update($enrollment, [
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);
    }

    public function test_update_allows_valid_change()
    {
        $student = Student::factory()->create();
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        $enrollment = Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course1->id,
        ]);

        $service = new EnrollmentService();

        $updated = $service->update($enrollment, [
            'student_id' => $student->id,
            'course_id' => $course2->id,
        ]);

        $this->assertEquals($course2->id, $updated->course_id);
    }
}
