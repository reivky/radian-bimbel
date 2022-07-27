@extends('admin.layouts.main')
{{-- @dd($teachers->render()) --}}
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajar Radian Bimbel</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm">Tambah Data Pengajar</a>
        </div>
        <div class="card-body">
            <livewire:teacher-component></livewire:teacher-component>
            {{-- @foreach ($teachers as $item)
                <ul>
                    <li>{{ $item->name }}</li>
                    <li>{{ $item->city }}</li>
                </ul>
            @endforeach
            {{ $teachers->links() }} --}}
        </div>
    </div>

</div>
@endsection