@extends('layouts.student')

@section('title', 'Editar Perfil')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-lg">

<form method="POST" action="{{ route('student.profile.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Nome</label>
        <input type="text" name="name"
               value="{{ old('name', $student->name) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $student->email) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Data de Nascimento</label>
        <input type="date" name="birth_date"
               value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Nova Senha</label>
        <input type="password" name="password"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation"
               class="w-full border rounded p-2">
    </div>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
        Salvar
    </button>

</form>

</div>

@endsection
