<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $service
    ) {}

    public function index(Request $request)
    {
        $students = $this->service->list($request->only('name', 'email'));

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Aluno criado com sucesso.');
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->service->update($student, $request->validated());

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Aluno atualizado com sucesso.');
    }

    public function destroy(Student $student)
    {
        $this->service->delete($student);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Aluno removido com sucesso.');
    }
}
