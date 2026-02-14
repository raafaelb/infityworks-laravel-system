@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Editar Curso</h1>

<form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Título</label>
        <input type="text" name="title"
               value="{{ old('title', $course->title) }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Descrição</label>
        <textarea name="description" class="w-full border rounded p-2">{{ old('description', $course->description) }}
        </textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Data de início</label>
            <input type="date" name="start_date"
                   value="{{ old('start_date', optional($course->start_date)->format('Y-m-d')) }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label>Data de fim</label>
            <input type="date" name="end_date"
                   value="{{ old('end_date', optional($course->end_date)->format('Y-m-d')) }}"
                   class="w-full border rounded p-2">
        </div>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Atualizar
    </button>
</form>

@endsection
