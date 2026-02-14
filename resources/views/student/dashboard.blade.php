@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Cards Resumo --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Cursos</h3>
            <p class="text-2xl font-bold">
                {{ $student->enrollments->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Disciplinas</h3>
            <p class="text-2xl font-bold">
                {{ $student->enrollments->flatMap(fn($e) => $e->course->subjects)->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Professores</h3>
            <p class="text-2xl font-bold">
                {{
                    $student->enrollments
                        ->flatMap(fn($e) => $e->course->subjects)
                        ->pluck('teacher')
                        ->unique('id')
                        ->count()
                }}
            </p>
        </div>

    </div>

    {{-- Lista detalhada --}}
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Meus Cursos</h2>

        @forelse($student->enrollments as $enrollment)

            <div class="mb-6 border-b pb-4">

                <h3 class="font-semibold text-lg">
                    {{ $enrollment->course->title }}
                </h3>

                <p class="text-sm text-gray-500 mb-2">
                    Matrícula em {{ $enrollment->created_at->format('d/m/Y') }}
                </p>

                <ul class="list-disc pl-6 text-sm">
                    @foreach($enrollment->course->subjects as $subject)
                        <li>
                            {{ $subject->title }}
                            - Prof. {{ $subject->teacher->name ?? 'Não definido' }}
                        </li>
                    @endforeach
                </ul>

            </div>

        @empty
            <p>Nenhum curso matriculado.</p>
        @endforelse

    </div>

</div>

@endsection
