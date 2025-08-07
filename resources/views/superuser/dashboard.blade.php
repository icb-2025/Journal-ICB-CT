@extends('layouts.super')

@section('title', 'Dashboard Super Admin')

@section('content')

<div class="mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Siswa</h3>
        <div class="flex space-x-2">
            <form id="filterForm" method="GET" action="{{ route('superuser.dashboard') }}" class="flex items-center space-x-4">
                <select name="time_range" id="timeRange" class="border rounded px-3 py-1 text-sm">
                    <option value="week" {{ request('time_range', 'week') == 'week' ? 'selected' : '' }}>Harian</option>
                    <option value="month" {{ request('time_range') == 'month' ? 'selected' : '' }}>Mingguan</option>
                    <option value="year" {{ request('time_range') == 'year' ? 'selected' : '' }}>Bulanan</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
                    Filter
                </button>
                @if(request('time_range'))
                <a href="{{ route('superuser.dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                    Reset
                </a>
                @endif
            </form>
        </div>
    </div>
    
    <canvas id="chartAktivitasHarian" height="100"></canvas>
</div>

<script>
    // Destroy previous chart if exists
    if (window.myChart) {
        window.myChart.destroy();
    }

    const labels = {!! json_encode($labels) !!};
    const datasets = {!! json_encode($datasets) !!};
    
    // Get the selected time range from the form
    const timeRange = "{{ request('time_range', 'week') }}";
    let chartTitle = 'Aktivitas Siswa per Jurusan';
    let xAxisLabel = 'Hari';
    
    // Set appropriate title based on time range
    switch(timeRange) {
        case 'week':
            chartTitle += ' (Mingguan)';
            xAxisLabel = 'Hari (Senin-Jumat)';
            break;
        case 'month':
            chartTitle += ' (Bulanan)';
            xAxisLabel = 'Minggu dalam Bulan';
            break;
        case 'year':
            chartTitle += ' (Tahunan)';
            xAxisLabel = 'Bulan';
            break;
    }

    console.log("Labels:", labels);
    console.log("Datasets:", datasets);

    const ctx = document.getElementById('chartAktivitasHarian').getContext('2d');
    
    // Store chart instance in window for future destruction
    window.myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: chartTitle
                },
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Aktivitas'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: xAxisLabel
                    }
                }
            }
        }
    });
</script>
@endsection