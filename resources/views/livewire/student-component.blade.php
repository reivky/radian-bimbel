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
                    <th width="15%">Nama</th>
                    <th>Domisili</th>
                    <th>Program Les</th>
                    <th>Jenjang</th>
                    <th width="20%">Mapel</th>
                    <th>No WA</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($students->total())
                @foreach ($students as $key => $student)
                <tr>
                    <th>{{ ($students->currentpage()-1) * $students->perpage() + $loop->iteration }}</th>
                    <td data-name="Nama">{{ $student->name }}</td>
                    <td data-name="Domisili">{{ $student->city }}</td>
                    <td data-name="Program Les">{{ $student->program }}</td>
                    <td data-name="Jenjang">{{ $student->study_level ? $student->study_level : '-' }}</td>
                    <td data-name="Mapel">{{ $student->lesson ? $student->lesson : '-'}}</td>
                    <td data-name="No WA">{{ $student->phone }}</td>
                    <td class="action">
                        <a href="#" title="ubah" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $student->id }})"><i class="far fa-edit"></a></i>&nbsp;
                        <a href="#" title="hapus" data-toggle="modal" data-target="#deleteModal" wire:click="delete({{ $student->id }})"><i class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @if (!$students->total())
        <div class="text-center mt-2">Data Siswa tidak ditemukan</div>
        @endif
        <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
         {{ $students->onEachSide(0)->links() }}
        </div>
    </div>
    
    
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Siswa</h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="name" placeholder="" wire:model="name">
                                @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Kota Domisili</label>
                                <input type="text" class="form-control form-control-sm" id="city" placeholder="" wire:model="city">
                                @error('city') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program">Program Les</label>
                                <select wire:model="program" class="form-control form-control-sm" name="program" id="program">
                                    <option value="Les Privat Offline">Les Privat Offline</option>
                                    <option value="Les Privat Online">Les Privat Online</option>
                                    <option value="Les Kilat Offline">Les Kilat Offline</option>
                                    <option value="Les Kilat Online">Les Kilat Online</option>
                                </select>
                                @error('program') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="study_level">Jenjang <small class="text-secondary">(optional)</small></label>
                                <input type="text" class="form-control form-control-sm" id="study_level" placeholder="ex. SMA" wire:model="study_level">
                                @error('study_level') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lesson">Mapel <small class="text-secondary">(optional)</small></label>
                        <textarea wire:model="lesson" name="lesson" class="form-control form-control-sm" id="lesson" rows="2" placeholder="ex. Matematika"></textarea>
                        @error('lesson') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor WhatsApp</label>
                        <input type="number" class="form-control form-control-sm" id="phone" placeholder="" wire:model="phone">
                        @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
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
            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Siswa</h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="name" placeholder="" wire:model="name">
                                @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Kota Domisili</label>
                                <input type="text" class="form-control form-control-sm" id="city" placeholder="" wire:model="city">
                                @error('city') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program">Program Les</label>
                                <select wire:model="program" class="form-control form-control-sm" name="program" id="program">
                                    <option value="Les Privat Offline">Les Privat Offline</option>
                                    <option value="Les Privat Online">Les Privat Online</option>
                                    <option value="Les Kilat Offline">Les Kilat Offline</option>
                                    <option value="Les Kilat Online">Les Kilat Online</option>
                                </select>
                                @error('program') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="study_level">Jenjang</label>
                                <input type="text" class="form-control form-control-sm" id="study_level" placeholder="" wire:model="study_level">
                                @error('study_level') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lesson">Mapel</label>
                        <textarea wire:model="lesson" name="lesson" class="form-control form-control-sm" id="lesson" rows="2"></textarea>
                        @error('lesson') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor WhatsApp</label>
                        <input type="number" class="form-control form-control-sm" id="phone" placeholder="" wire:model="phone">
                        @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
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
