<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
