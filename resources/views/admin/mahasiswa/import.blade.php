@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('content')
  <form action="{{ route('admin.mahasiswa.index') }}" enctype="multipart/form-data">
    <div class="d-flex justify-content-end">
    <input type="file" name="file" required class="form-control me-2">
    <button type="submit" class="btn btn-primary">Import Mahasiswa</button>
    </div>
  </form>


@endsection