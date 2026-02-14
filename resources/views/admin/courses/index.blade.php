@extends('layouts.admin')

@section('title', 'Cursos')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.courses.create') }}"
    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
    Novo Curso
    </a>
</div>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead>
        <tr class="border-b">
            <th class="p-2 text-left">Título</th>
            <th class="p-2 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr class="border-b">
                <td class="p-2 text-left">{{ $course->title }}</td>
                <td class="p-2 text-center space-x-2">
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.courses.show', $course) }}">Ver</a>
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.courses.edit', $course) }}">Editar</a>

                    <form action="{{ route('admin.courses.destroy', $course) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" type="submit">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $courses->links() }}
</div>

@endsection
