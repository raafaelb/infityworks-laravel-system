<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_access_dashboard()
    {
        $user = User::factory()->create([
            'role' => UserRole::STUDENT
        ]);

        $student = Student::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
            ->get('/student/dashboard');

        $response->assertStatus(200);
    }

    public function test_dashboard_loads_relationships()
    {
        $user = User::factory()->create([
            'role' => UserRole::STUDENT
        ]);

        $student = Student::factory()->create([
            'user_id' => $user->id
        ]);

        $course = Course::factory()->create();

        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/student/dashboard');

        $response->assertSee($course->title);
    }
}
