<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TeacherService
{
    public function list(): LengthAwarePaginator
    {
        return Teacher::orderBy('id', 'desc')->paginate(10);
    }

    public function show(Teacher $teacher): Teacher
    {
        return $teacher->load([
            'subjects',
            'subjects.course'
        ]);
    }

    public function create(array $data): Teacher
    {
        return Teacher::create($data);
    }

    public function update(Teacher $teacher, array $data): Teacher
    {
        $teacher->update($data);
        return $teacher;
    }

    public function delete(Teacher $teacher): void
    {
        $teacher->delete();
    }
}
