@extends('layouts.admin')

@section('title', 'Editar Professor')

@section('content')

<form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block">Nome</label>
        <input type="text" name="name" class="w-full border rounded p-2" value="{{ $teacher->name }}">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block">E-mail</label>
        <input type="text" name="email" class="w-full border rounded p-2" value="{{ $teacher->email }}">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Atualizar
    </button>
</form>

@endsection
