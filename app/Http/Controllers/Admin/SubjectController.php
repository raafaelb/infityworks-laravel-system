<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Teacher;
use App\Services\SubjectService;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $service
    ) {}

    public function index()
    {
        $subjects = $this->service->list();

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('admin.subjects.create', compact('courses', 'teachers'));
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Disciplina criada.');
    }

    public function edit(Subject $subject)
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('admin.subjects.edit', compact('subject','courses','teachers'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->service->update($subject, $request->validated());

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Disciplina atualizada.');
    }

    public function show(Subject $subject)
    {
        $subject = $this->service->show($subject);
        return view('admin.subjects.show', compact('subject'));
    }

    public function destroy(Subject $subject)
    {
        $this->service->delete($subject);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Disciplina removida.');
    }
}
