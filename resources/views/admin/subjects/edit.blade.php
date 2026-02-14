@extends('layouts.admin')

@section('title', 'Editar Disciplina')

@section('content')

<form method="POST" action="{{ route('admin.subjects.update', $subject) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Título</label>
        <input type="text" name="title"
               value="{{ old('title', $subject->title) }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Descrição</label>
        <textarea name="description"
                  class="w-full border rounded p-2">{{ old('description', $subject->description) }}</textarea>
    </div>

    <div>
        <label>Curso</label>
        <select name="course_id" class="w-full border rounded p-2">
            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ $course->id == $subject->course_id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Professor</label>
        <select name="teacher_id" class="w-full border rounded p-2">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}"
                    {{ $teacher->id == $subject->teacher_id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Atualizar
    </button>
</form>

@endsection
