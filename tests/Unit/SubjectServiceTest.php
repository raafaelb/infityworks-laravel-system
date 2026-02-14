<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Teacher;
use App\Services\SubjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_subject()
    {
        $service = new SubjectService();

        $subject = $service->create([
            'title' => 'Matemática',
            'description' => 'Desc',
            'course_id' => Course::factory()->create()->id,
            'teacher_id' => Teacher::factory()->create()->id,
        ]);

        $this->assertDatabaseHas('subjects', [
            'title' => 'Matemática'
        ]);
    }
}
