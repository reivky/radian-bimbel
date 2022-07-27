@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pendaftar Baru</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <livewire:registrant-component></livewire:registrant-component>
        </div>
    </div>

</div>
@endsection