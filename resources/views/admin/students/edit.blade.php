@extends('layouts.admin')

@section('title', 'Editar Aluno')

@section('content')

<form method="POST" action="{{ route('admin.students.update', $student) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Nome</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}"
               class="w-full border rounded p-2">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $student->email) }}"
               class="w-full border rounded p-2">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Data de Nascimento</label>
        <input type="date" name="birth_date"
               value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Senha (deixe em branco para manter a atual)</label>
        <input type="password" name="password" value="{{ old('password') }}"
               class="w-full border rounded p-2">
        @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Confirme a Senha</label>
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
               class="w-full border rounded p-2">
        @error('password_confirmation') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Salvar
    </button>
</form>

@endsection
