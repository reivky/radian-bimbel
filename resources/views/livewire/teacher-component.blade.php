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

    <div class="row mb-2 index-search">
        <div class="col">
            <select wire:model="paginate" name="pagination" id="pagination" class="form-control form-control-sm form-select-sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="col">
            <input wire:model="search" type="text" class="form-control form-control-sm float-right search-form" placeholder="Cari" name="search">
        </div>
    </div>
    <div class="table-responsive">
        <table class="" id="" width="100%" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Domisili</th>
                    <th>No WA</th>
                    <th>Total Siswa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($teachers->total()) 
                @foreach ($teachers as $teacher)
                <tr>
                    <th>{{ ($teachers->currentpage()-1) * $teachers->perpage() + $loop->iteration }}</th>
                    <td data-name="Nama">{{ $teacher->name }}</td>
                    <td data-name="Domisili">{{ $teacher->city }}</td>
                    <td data-name="Nomor WA">{{ $teacher->phone }}</td>
                    <td data-name="Total Siswa">{{ $teacher->student_totals }}</td>
                    <td data-name="Status">
                        @if ($teacher->status == 0)
                        <button type="button" class="btn-status badge bg-danger btn-block text-white border-0">Berhenti</button>
                        @elseif($teacher->status == 2)
                        <button type="button" class="btn-status badge bg-secondary btn-block text-white border-0">Libur</button>
                        @else
                        <button type="button" class="btn-status badge bg-success btn-block text-white border-0">Aktif</button>
                        @endif
                    </td>
                    <td class="action">
                        <a href="#" title="ubah" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $teacher->id }})"><i class="far fa-edit"></a></i>&nbsp;
                        <a href="#" title="hapus" data-toggle="modal" data-target="#deleteModal" wire:click="delete({{ $teacher->id }})"><i class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @if (!$teachers->total())
        <div class="text-center mt-2">Data Pengajar tidak ditemukan</div>
        @endif
        <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
         {{ $teachers->onEachSide(0)->links() }}
        </div>
    </div>
    
    
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Pengajar</h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-sm" id="name" placeholder="" wire:model="name">
                        @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="city">Kota Domisili</label>
                        <input type="text" class="form-control form-control-sm" id="city" placeholder="" wire:model="city">
                        @error('city') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor WhatsApp</label>
                        <input type="number" class="form-control form-control-sm" id="phone" placeholder="" wire:model="phone">
                        @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="student_totals">Total Siswa Diajar <small class="text-secondary">(optional)</small></label>
                        <input type="number" class="form-control form-control-sm" id="student_totals" placeholder="" wire:model="student_totals">
                        @error('student_totals') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="1" wire:model="student_totals">
                        @error('status') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button> --}}
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-block btn-sm close-modal">Simpan</button>
            </div>
        </div>
        </div>
    </div>
    {{-- modal update --}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" style="color: black">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Pengajar</h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-sm" id="name" placeholder="" wire:model="name">
                        @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="city">Kota Domisili</label>
                        <input type="text" class="form-control form-control-sm" id="city" placeholder="" wire:model="city">
                        @error('city') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor WhatsApp</label>
                        <input type="number" class="form-control form-control-sm" id="phone" placeholder="" wire:model="phone">
                        @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="student_totals">Total Siswa Diajar</label>
                        <input type="number" class="form-control form-control-sm" id="student_totals" placeholder="" wire:model="student_totals">
                        @error('student_totals') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control form-control-sm" wire:model="status">
                            <option value="1">Aktif</option>
                            <option value="2">Libur</option>
                            <option value="0">Berhenti</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button> --}}
                <button type="button" wire:click.prevent="update()" class="btn btn-success btn-block btn-sm close-modal">Simpan</button>
            </div>
        </div>
        </div>
    </div>
    {{-- modal delete --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered delete-modal " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center mx-auto my-auto" id="exampleModalLabel">Apakah kamu yakin?</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" wire:click.prevent="cancel()">
                         <span aria-hidden="true close-btn">×</span>
                    </button> --}}
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
