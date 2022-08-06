<div>
    
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible small fade show p-2" role="alert">
        {{ session('success') }}
        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif(session()->has('failed'))
    <div class="alert alert-danger alert-dismissible small fade show p-2" role="alert">
        {{ session('failed') }}
        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <form class="mb-4">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control form-control-sm" id="name" name="name" wire:model="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model="email" type="email" class="form-control form-control-sm" id="email" name="email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button wire:click.prevent="updateProfile()" type="button" class="btn btn-sm btn-primary" style="width: 5rem">Simpan</button>
    </form>
    <hr class="my-4">
    <h5 class="text-secondary">Need to change password?</h5>

    <form class="mt-3 mb-3">
        <div class="form-group">
            <label for="old_password">Password lama</label>
            <input wire:model="old_password" type="password" class="form-control form-control-sm" id="old_password" name="old_password">
            @error('old_password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if (session()->has('password_not_match'))
                <small class="text-danger"> {{ session('password_not_match') }}</small>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password baru</label>
                    <input wire:model="password" type="password" class="form-control form-control-sm" id="password" name="password">
                    @error('password')
                    <small class="text-danger"> {{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi password baru</label>
                    <input wire:model="password_confirmation" type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                    <small class="text-danger"> {{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button wire:click.prevent="updatePassword()" type="button" class="btn btn-sm btn-primary" style="width: 5rem">Simpan</button>
    </form>

    {{-- modal tolak --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered delete-modal " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center mx-auto my-auto" id="exampleModalLabel">Apakah kamu yakin?</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" wire:click.prevent="cancel()">
                         <span aria-hidden="true close-btn">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <p>Data pendaftar yang ditolak akan terhapus</p>
                </div>
                <div class="row p-3">
                    <div class="col">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-sm btn-secondary btn-block" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col">
                        <button type="button" wire:click.prevent="destroy()" class="btn btn-sm btn-danger btn-block close-modal">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
