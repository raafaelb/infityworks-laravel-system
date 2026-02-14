@extends('layouts.admin')

@section('title', 'Detalhes da Matrícula')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Matrícula #{{ $enrollment->id }}
</h1>

<div class="bg-white shadow rounded p-6 mb-8 space-y-4">

    <div>
        <strong>Aluno:</strong>
        <p class="text-gray-700 mt-1">
            {{ $enrollment->student->name }}
        </p>
    </div>

    <div>
        <strong>Curso:</strong>
        <p class="text-gray-700 mt-1">
            {{ $enrollment->course->title }}
        </p>
    </div>

    <div>
        <strong>Data da Matrícula:</strong>
        <p class="text-gray-700 mt-1">
            {{ $enrollment->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

</div>

<a href="{{ route('admin.enrollments.index') }}"
   class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
   Voltar
</a>

@endsection
