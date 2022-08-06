@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="col-lg-10 mx-auto px-0">
        <h1 class="h3 mb-2 text-gray-800">Profil Saya</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="">
            <div class="card-body">
                <livewire:profile-component></livewire:profile-component>
            </div>
        </div>
    </div>

</div>
@endsection