@extends('layouts.admin')

@section('title', 'Editar Matrícula')

@section('content')

<form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}"
      class="bg-white shadow rounded p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium mb-1">Aluno</label>
        <select name="student_id"
                class="w-full border rounded px-3 py-2">
            @foreach($students as $student)
                <option value="{{ $student->id }}"
                    {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Curso</label>
        <select name="course_id"
                class="w-full border rounded px-3 py-2">
            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex space-x-3">
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
            Atualizar
        </button>

        <a href="{{ route('admin.enrollments.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
           Cancelar
        </a>
    </div>

</form>

@endsection
