<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseService
{
    public function list(array $filters = []): LengthAwarePaginator
    {
        return Course::query()
            ->when($filters['title'] ?? null, function ($query, $title) {
                $query->where('title', 'like', "%{$title}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function show(Course $course): Course
    {
        return $course->load([
            'subjects.teacher',
            'enrollments.student'
        ]);
    }

    public function create(array $data): Course
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);

        return $course;
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }
}
