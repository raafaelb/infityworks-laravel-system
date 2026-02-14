@extends('layouts.admin')

@section('title', 'Professores')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.teachers.create') }}"
    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
    Novo Professor
    </a>
</div>

<table class="w-full bg-white shadow rounded overflow-hidden text-left">
    <thead>
        <tr class="border-b">
            <th class="p-2 text-left">Nome</th>
            <th class="p-2 text-center">Email</th>
            <th class="p-2 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
            <tr class="border-b">
                <td class="p-2 text-left">{{ $teacher->name }}</td>
                <td class="p-2 text-center">{{ $teacher->email }}</td>
                <td class="p-2 text-center space-x-2">
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.teachers.show', $teacher) }}">Ver</a>
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.teachers.edit', $teacher) }}">Editar</a>

                    <form method="POST"
                          action="{{ route('admin.teachers.destroy', $teacher) }}"
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
    {{ $teachers->links() }}
</div>

@endsection
