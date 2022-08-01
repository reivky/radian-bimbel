@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Jadwal Les</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
            <livewire:schedule-component></livewire:schedule-component>
    </div>

</div>
@endsection