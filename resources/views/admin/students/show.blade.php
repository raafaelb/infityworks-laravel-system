@extends('layouts.admin')

@section('title', 'Detalhes do Aluno')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <p><strong>Nome:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Idade:</strong> {{ $student->age }}</p>

    <h3 class="text-xl font-bold mt-6 mb-3">Cursos Matriculados</h3>

    <ul class="list-disc pl-6">
        @foreach($student->courses as $course)
            <li>{{ $course->title }}</li>
        @endforeach
    </ul>

</div>

@endsection
