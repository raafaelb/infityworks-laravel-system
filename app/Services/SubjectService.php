<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SubjectService
{
    public function list(): LengthAwarePaginator
    {
        return Subject::with(['course', 'teacher'])
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function show(Subject $subject): Subject
    {
        $subject->load(['course', 'teacher']);

        return $subject;
    }

    public function create(array $data): Subject
    {
        return Subject::create($data);
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update($data);
        return $subject;
    }

    public function delete(Subject $subject): void
    {
        $subject->delete();
    }
}
