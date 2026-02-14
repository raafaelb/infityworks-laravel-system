@extends('layouts.admin')

@section('title', 'Detalhes do Curso')

@section('content')

<h1 class="text-2xl font-bold mb-6">{{ $course->title }}</h1>

<div class="bg-white shadow rounded p-6 mb-8">
    <p><strong>Descrição:</strong> {{ $course->description }}</p>
    <p><strong>Início:</strong> {{ optional($course->start_date)->format('d/m/Y') }}</p>
    <p><strong>Fim:</strong> {{ optional($course->end_date)->format('d/m/Y') }}</p>
</div>

{{-- Matérias --}}
<div class="bg-white shadow rounded p-6 mb-8">
    <h2 class="text-xl font-semibold mb-4">Matérias</h2>

    @forelse($course->subjects as $subject)
        <div class="border-b py-2">
            <p class="font-medium">{{ $subject->title }}</p>
            <p class="text-sm text-gray-600">
                Professor: {{ $subject->teacher->name ?? 'Não definido' }}
            </p>
        </div>
    @empty
        <p>Nenhuma matéria cadastrada.</p>
    @endforelse
</div>

{{-- Alunos --}}
<div class="bg-white shadow rounded p-6 mb-8">
    <h2 class="text-xl font-semibold mb-4">Alunos Matriculados</h2>

    @forelse($course->enrollments as $enrollment)
        <div class="border-b py-2">
            {{ $enrollment->student->name }}
        </div>
    @empty
        <p>Nenhum aluno matriculado.</p>
    @endforelse
</div>

<a href="{{ route('admin.courses.index') }}"
   class="inline-block mt-4 bg-gray-500 text-white px-4 py-2 rounded">
   Voltar
</a>

@endsection
