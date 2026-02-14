@extends('layouts.admin')

@section('title', 'Nova Matrícula')

@section('content')

<form method="POST" action="{{ route('admin.enrollments.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Aluno</label>
        <select name="student_id" class="w-full border rounded p-2">
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Curso</label>
        <select name="course_id" class="w-full border rounded p-2">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Matricular
    </button>
</form>

@endsection
