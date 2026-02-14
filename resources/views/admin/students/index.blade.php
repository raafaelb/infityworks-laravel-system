@extends('layouts.admin')

@section('title', 'Alunos')

@section('content')

<form method="GET"
      class="mb-6 flex flex-col sm:flex-row gap-4 sm:items-end">

    <div class="flex flex-col w-full">
        <label class="text-sm text-gray-600 mb-1">Nome</label>
        <input type="text"
               name="name"
               value="{{ request('name') }}"
               placeholder="Nome"
               class="border p-2 rounded w-full">
    </div>

    <div class="flex flex-col w-full">
        <label class="text-sm text-gray-600 mb-1">Email</label>
        <input type="text"
               name="email"
               value="{{ request('email') }}"
               placeholder="Email"
               class="border p-2 rounded w-full">
    </div>

    <button
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow w-full sm:w-auto">
        Filtrar
    </button>

</form>


<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.students.create') }}"
    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
    Novo Aluno
    </a>
</div>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead>
        <tr class="border-b">
            <th class="p-2 text-left">Nome</th>
            <th class="p-2 text-center">Email</th>
            <th class="p-2 text-center">Idade</th>
            <th class="p-2 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr class="border-b">
                <td class="p-2 text-left">{{ $student->name }}</td>
                <td class="p-2 text-center">{{ $student->email }}</td>
                <td class="p-2 text-center">
                    {{ $student->age ?? '-' }}
                </td>
                <td class="p-2 text-center space-x-2">
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.students.show', $student) }}">Ver</a>
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('admin.students.edit', $student) }}">Editar</a>

                    <form method="POST"
                          action="{{ route('admin.students.destroy', $student) }}"
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
    {{ $students->withQueryString()->links() }}
</div>

@endsection
