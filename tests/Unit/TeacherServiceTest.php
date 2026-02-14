<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_teacher()
    {
        $service = new TeacherService();

        $teacher = $service->create([
            'name' => 'Professor Teste',
            'email' => 'prof@test.com',
        ]);

        $this->assertDatabaseHas('teachers', [
            'email' => 'prof@test.com'
        ]);

        $this->assertInstanceOf(Teacher::class, $teacher);
    }
}
