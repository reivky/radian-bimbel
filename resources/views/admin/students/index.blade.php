@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Siswa Radian Bimbel</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm">Tambah Data Siswa</a>
        </div>
        <div class="card-body">
            <livewire:student-component></livewire:student-component>
        </div>
    </div>

</div>
@endsection