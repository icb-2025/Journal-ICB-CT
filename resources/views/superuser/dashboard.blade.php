@extends('layouts.super')

@section('title', 'Dashboard Super Admin')

@section('content')
<div class="mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Siswa</h3>
        <div class="flex space-x-2">
            <form id="filterForm" class="flex items-center space-x-4">
                <select name="time_range" id="timeRange" class="border rounded px-3 py-1 text-sm">
                    <option value="week" {{ request('time_range', 'week') == 'week' ? 'selected' : '' }}>Harian</option>
                    <option value="month" {{ request('time_range') == 'month' ? 'selected' : '' }}>Mingguan</option>
                    <option value="year" {{ request('time_range') == 'year' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </form>
        </div>
    </div>
    
    <canvas id="chartAktivitasHarian" height="100"></canvas>
</div>

<script>
    let chart;

    function initChart(labels, datasets, timeRange) {
        const ctx = document.getElementById('chartAktivitasHarian').getContext('2d');
        
        if (chart) {
            chart.destroy();
        }

        const titleMap = {
            'week': 'Aktivitas Siswa per Jurusan (Harian)',
            'month': 'Aktivitas Siswa per Jurusan (Mingguan)',
            'year': 'Aktivitas Siswa per Jurusan (Bulanan)'
        };

        const xLabelMap = {
            'week': 'Hari (Senin-Jumat)',
            'month': 'Minggu dalam Bulan',
            'year': 'Bulan'
        };

        chart = new Chart(ctx, {
            type: 'line',
            data: { labels, datasets },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: titleMap[timeRange]
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Aktivitas' },
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        title: { display: true, text: xLabelMap[timeRange] }
                    }
                }
            }
        });
    }

    // Initialize chart with initial data
    initChart(
        @json($labels),
        @json($datasets),
        "{{ request('time_range', 'week') }}"
    );

    // Handle filter change
    document.getElementById('timeRange').addEventListener('change', function() {
        const timeRange = this.value;
        
        fetch(`{{ route('superuser.dashboard') }}?time_range=${timeRange}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            initChart(data.labels, data.datasets, data.time_range);
            // Update URL without reload
            history.pushState(null, '', `?time_range=${timeRange}`);
        })
        .catch(error => console.error('Error:', error));
    });

    window.addEventListener('dashboardUpdated', function(e) {
        const data = e.detail;
        initChart(data.labels, data.datasets, data.time_range);
    });
</script>
@endsection