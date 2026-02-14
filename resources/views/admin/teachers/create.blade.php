@extends('layouts.admin')

@section('title', 'Novo Professor')

@section('content')

<form method="POST" action="{{ route('admin.teachers.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Nome</label>
        <input type="text" name="name"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email"
               class="w-full border rounded p-2">
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Salvar
    </button>
</form>

@endsection
