@extends('layouts.admin')

@section('title', 'Detalhes do Professor')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    {{ $teacher->name }}
</h1>

<div class="bg-white shadow rounded p-6 mb-8">
    <p><strong>Email:</strong> {{ $teacher->email }}</p>
</div>

{{-- Matérias do Professor --}}
<div class="bg-white shadow rounded p-6 mb-8">
    <h2 class="text-xl font-semibold mb-4">Matérias Ministradas</h2>

    @forelse($teacher->subjects as $subject)
        <div class="border-b py-3">
            <p class="font-medium text-lg">
                {{ $subject->title }}
            </p>

            <p class="text-sm text-gray-600">
                Curso:
                <span class="font-medium">
                    {{ $subject->course->title ?? 'Curso não definido' }}
                </span>
            </p>
        </div>
    @empty
        <p class="text-gray-500">
            Este professor ainda não possui matérias cadastradas.
        </p>
    @endforelse
</div>

<a href="{{ route('admin.teachers.index') }}"
   class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
   Voltar
</a>

@endsection
