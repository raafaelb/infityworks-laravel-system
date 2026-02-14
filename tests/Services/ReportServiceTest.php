<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use App\Services\ReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_returns_age_statistics()
    {
        $course = Course::factory()->create();

        $student1 = Student::factory()->create([
            'birth_date' => now()->subYears(20)
        ]);

        $student2 = Student::factory()->create([
            'birth_date' => now()->subYears(30)
        ]);

        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course->id,
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course->id,
        ]);

        $service = new ReportService();
        $report = $service->dashboard();
        $courseReport = $report['courses'][0];

        $this->assertEquals(25, $courseReport['average_age']);
        $this->assertEquals(20, $courseReport['youngest']);
        $this->assertEquals(30, $courseReport['oldest']);
    }
}
