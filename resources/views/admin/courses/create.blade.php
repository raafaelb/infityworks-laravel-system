@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Novo Curso</h1>

<form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block">Título</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full border rounded p-2">
        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block">Descrição</label>
        <textarea name="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Data de início</label>
            <input type="date" name="start_date"
                   value="{{ old('start_date') }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label>Data de fim</label>
            <input type="date" name="end_date"
                   value="{{ old('end_date') }}"
                   class="w-full border rounded p-2">
        </div>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Salvar
    </button>
</form>

@endsection
