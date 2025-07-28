@extends('layouts.guru')

@section('title', 'Laporan Aktivitas Siswa')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Laporan Aktivitas Siswa</h3>
        <div>
            <a href="{{ route('laporan.export.excel') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('guru.laporan.export') }}" class="btn btn-danger ml-2">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <input type="text" id="search" class="form-control" placeholder="Cari aktivitas...">
            </div>
            
            <div id="table-container">
                @include('guru.laporan.partials.table', ['aktivitas' => $aktivitas])
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        let search = $(this).val();
        
        $.ajax({
            url: "{{ route('laporan.index') }}",
            type: "GET",
            data: { search: search },
            success: function(data) {
                $('#table-container').html(data);
            }
        });
    });
});
</script>
@endpush
@endsection