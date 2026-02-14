@extends('layouts.admin')

@section('title', 'Detalhes da Disciplina')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    {{ $subject->title }}
</h1>

<div class="bg-white shadow rounded p-6 mb-8 space-y-4">

    <div>
        <strong>Descrição:</strong>
        <p class="text-gray-700 mt-1">
            {{ $subject->description ?? 'Sem descrição cadastrada.' }}
        </p>
    </div>

    <div>
        <strong>Curso:</strong>
        <p class="text-gray-700 mt-1">
            {{ $subject->course->title ?? 'Não vinculado' }}
        </p>
    </div>

    <div>
        <strong>Professor:</strong>
        <p class="text-gray-700 mt-1">
            {{ $subject->teacher->name ?? 'Não vinculado' }}
        </p>
    </div>

</div>

<a href="{{ route('admin.subjects.index') }}"
   class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
   Voltar
</a>

@endsection
