<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $service
    ) {}

    public function index()
    {
        $teachers = $this->service->list();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Professor criado.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $this->service->update($teacher, $request->validated());

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Professor atualizado.');
    }

    public function show(Teacher $teacher)
    {
        $teacher = $this->service->show($teacher);
        return view('admin.teachers.show', compact('teacher'));
    }

    public function destroy(Teacher $teacher)
    {
        $this->service->delete($teacher);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Professor removido.');
    }
}
