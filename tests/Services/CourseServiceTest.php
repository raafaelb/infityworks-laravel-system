<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_course()
    {
        $service = new CourseService();

        $course = $service->create([
            'title' => 'Curso Teste',
            'description' => 'Descrição',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'Curso Teste'
        ]);

        $this->assertInstanceOf(Course::class, $course);
    }
}
