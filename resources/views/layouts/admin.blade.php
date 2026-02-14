<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Administrador - {{ config('app.name') }}
        @hasSection('title')
            - @yield('title')
        @endif
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    {{-- Overlay mobile --}}
    <div id="overlay"
         class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"
         onclick="toggleSidebar()">
    </div>

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="fixed lg:static z-40 w-64 h-screen lg:h-auto
                bg-indigo-700 text-white p-6
                transform -translate-x-full lg:translate-x-0
                transition-transform duration-300
                flex flex-col justify-between">

        <div>
            <h2 class="text-2xl font-bold border-b border-indigo-400 pb-3">
                Admin
            </h2>

            <nav class="space-y-3 text-sm mt-4">
                <a href="{{ route('admin.courses.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Cursos</a>
                <a href="{{ route('admin.teachers.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Professores</a>
                <a href="{{ route('admin.subjects.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Disciplinas</a>
                <a href="{{ route('admin.students.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Alunos</a>
                <a href="{{ route('admin.enrollments.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Matrículas</a>
                <a href="{{ route('admin.reports.index') }}" class="block hover:bg-indigo-600 p-2 rounded">Relatórios</a>
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="pt-6">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded">
                Sair
            </button>
        </form>

    </aside>

    {{-- Conteúdo --}}
    <div class="flex-1 flex flex-col">

        {{-- Topbar Mobile --}}
        <header class="lg:hidden bg-white shadow p-4 flex items-center justify-between">
            <button onclick="toggleSidebar()" class="text-indigo-700 font-bold">
                ☰
            </button>

            <span class="font-semibold">
                @yield('title')
            </span>
        </header>

        <main class="flex-1 p-4 lg:p-10">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-6">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="hidden lg:block text-3xl font-bold mb-8">
                @yield('title')
            </h1>

            @yield('content')

        </main>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>

@yield('scripts')

</body>
</html>
