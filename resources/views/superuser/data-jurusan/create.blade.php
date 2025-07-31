{{-- resources/views/superuser/data-jurusan/create.blade.php --}}
@extends('layouts.super')

@section('content')
<form action="{{ route('superuser.data-jurusan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nama Jurusan</label>
        <input type="text" name="nama_jurusan" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Tambah</button>
</form>
@endsection
