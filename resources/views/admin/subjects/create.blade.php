@extends('layouts.admin')

@section('title', 'Nova Disciplina')

@section('content')

<form method="POST" action="{{ route('admin.subjects.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Título</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Descrição</label>
        <textarea name="description"
                  class="w-full border rounded p-2">{{ old('description') }}</textarea>
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

    <div>
        <label>Professor</label>
        <select name="teacher_id" class="w-full border rounded p-2">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Salvar
    </button>
</form>

@endsection
