@extends('layouts.super')

@section('title', 'Dashboard Super Admin')

@section('content')

<!-- sudah aku pindahkan ke layout script chartjsnya -->

<div class="mt-10 bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Siswa per Hari (Senin - Jumat)</h3>
    <canvas id="chartAktivitasHarian" height="100"></canvas>
</div>

<script>
    const labels = {!! json_encode($labels) !!};
    const datasets = {!! json_encode($datasets) !!};

    console.log("Labels:", labels);
    console.log("Datasets:", datasets);

    const ctx = document.getElementById('chartAktivitasHarian').getContext('2d');

    new Chart(ctx, {
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
                    text: 'Aktivitas Siswa per Jurusan (Senin - Jumat)'
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
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Hari'
                    }
                }
            }
        }
    });
</script>
@endsection
