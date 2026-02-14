<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $service
    ) {}

    public function index(Request $request)
    {
        $courses = $this->service->list($request->all());

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso criado com sucesso.');
    }

    public function show(Course $course)
    {
        $course = $this->service->show($course);

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->service->update($course, $request->validated());

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso atualizado com sucesso.');
    }

    public function destroy(Course $course)
    {
        $this->service->delete($course);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso removido com sucesso.');
    }
}
