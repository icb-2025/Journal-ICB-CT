{{-- resources/views/superuser/data-jurusan/edit.blade.php --}}
@extends('layouts.super')

@section('content')
<form action="{{ route('superuser.data-jurusan.update', $data_jurusan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama Jurusan</label>
        <input type="text" name="nama_jurusan" value="{{ $data_jurusan->nama_jurusan }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
