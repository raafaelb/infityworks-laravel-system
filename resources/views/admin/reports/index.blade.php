@extends('layouts.admin')

@section('title', 'Dashboard de Relatórios')

@section('content')

{{-- Cards Resumo --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-10">

    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-sm text-gray-500">Cursos</p>
        <p class="text-2xl font-bold">{{ $summary['courses'] }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-sm text-gray-500">Alunos</p>
        <p class="text-2xl font-bold">{{ $summary['students'] }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-sm text-gray-500">Professores</p>
        <p class="text-2xl font-bold">{{ $summary['teachers'] }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-sm text-gray-500">Matrículas</p>
        <p class="text-2xl font-bold">{{ $summary['enrollments'] }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-sm text-gray-500">Média Geral Idade</p>
        <p class="text-2xl font-bold">
            {{ $summary['average_age'] ?? '-' }}
        </p>
    </div>

</div>

{{-- Tabela --}}
<table class="w-full bg-white shadow rounded mb-8 text-center">
    <thead>
        <tr class="border-b">
            <th class="p-2">Curso</th>
            <th class="p-2">Média</th>
            <th class="p-2">Mais Novo</th>
            <th class="p-2">Mais Velho</th>
            <th class="p-2">Total Alunos</th>
            <th class="p-2">Total Matérias</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $row)
            <tr class="border-b">
                <td class="p-2">{{ $row['course'] }}</td>
                <td class="p-2">{{ $row['average_age'] ?? '-' }}</td>
                <td class="p-2">{{ $row['youngest'] ?? '-' }}</td>
                <td class="p-2">{{ $row['oldest'] ?? '-' }}</td>
                <td class="p-2">{{ $row['students_count'] }}</td>
                <td class="p-2">{{ $row['subjects_count'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white p-6 rounded shadow h-80 lg:h-96">
        <canvas id="avgAgeChart"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow h-80 lg:h-96">
        <canvas id="studentsChart"></canvas>
    </div>
</div>



@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const data = @json($courses);

const labels = data.map(i => i.course);
const averages = data.map(i => i.average_age ?? 0);
const students = data.map(i => i.students_count);

new Chart(document.getElementById('avgAgeChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Média de Idade por Curso',
            data: averages
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('studentsChart'), {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            label: 'Alunos por Curso',
            data: students
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

</script>
@endsection
