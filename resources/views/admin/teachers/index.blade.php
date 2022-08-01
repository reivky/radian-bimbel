@extends('admin.layouts.main')
{{-- @dd($teachers->render()) --}}
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajar Radian Bimbel</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
            <livewire:teacher-component></livewire:teacher-component>
    </div>

</div>
@endsection