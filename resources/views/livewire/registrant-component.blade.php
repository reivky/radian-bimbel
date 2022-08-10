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
                    <th width="20%">Nama</th>
                    <th>Domisili</th>
                    <th>Program Les</th>
                    <th>No WA</th>
                    <th class="text-center" width="20%">Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($registrants->total())
                @foreach ($registrants as $key => $registrant)
                <tr>
                    <th>{{ ($registrants->currentpage()-1) * $registrants->perpage() + $loop->iteration }}</th>
                    <td data-name="Nama">{{ $registrant->name }}</td>
                    <td data-name="Domisili">{{ $registrant->city }}</td>
                    <td data-name="Program Les">{{ $registrant->program }}</td>
                    <td data-name="Nomor WA">{{ $registrant->phone }}</td>
                    <td data-name="Pesan" class="message">
                        {{ $registrant->message == null ? '-' : $registrant->message }}
                    </td>
                    <td data-name="Aksi" class=""><a href="#" title="terima" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $registrant->id }})" class="btn btn-outline-success btn-w-full btn-sm ">Terima</a>
                        <a href="#" title="tolak" data-toggle="modal" data-target="#deleteModal" wire:click="delete({{ $registrant->id }})" class="btn btn-outline-danger btn-w-full btn-sm ">Tolak</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @if (!$registrants->total())
        <div class="text-center mt-2">Data Pendaftar tidak ditemukan</div>
        @endif
        <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
         {{ $registrants->onEachSide(0)->links() }}
        </div>
    </div>

    {{-- modal terima --}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="color: black">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Atur jadwal Les </h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="name" placeholder="" wire:model="name">
                                @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">Kota Domisili</label>
                                <input type="text" class="form-control form-control-sm" id="city" placeholder="" wire:model="city">
                                @error('city') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
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
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Nomor WA</label>
                                <input type="number" class="form-control form-control-sm" id="phone" placeholder="" wire:model="phone">
                                @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="study_level">Jenjang Pendidikan <small class="text-secondary">(optional)</small></label>
                                <input type="text" wire:model="study_level" name="study_level" class="form-control form-control-sm" id="study_level" placeholder="ex. SMA">
                                @error('study_level') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lesson">Mapel <small class="text-secondary">(optional)</small></label>
                                <input type="text" class="form-control form-control-sm" id="lesson" placeholder="ex. Matematika" wire:model="lesson">
                                @error('lesson') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Tanggal Les</label>
                                <input type="date" wire:model="date" name="date" class="form-control form-control-sm" id="date">
                                @error('date') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time">Waktu (WIB) <small class="text-secondary">(optional)</small></label>
                                <input type="time" class="form-control form-control-sm" id="time" placeholder="" wire:model="time">
                                @error('time') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration">Durasi Les <small class="text-secondary">(optional)</small></label>
                                <input type="text" class="form-control form-control-sm" id="duration" placeholder="ex. 1 Jam" wire:model="duration">
                                @error('duration') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="teacher">Pengajar</label>
                        <select wire:model="teacher" name="teacher" id="teacher" class="teacher-select form-control form-control-sm form-select form-select-sm">
                            @if ($teachers)
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->name }}">{{ $teacher->name }} - {{ $teacher->city }}</option>
                            @endforeach
                            @else
                            <option value="-">Tidak ada pengajar</option>
                            @endif
                            
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Alamat <small class="text-secondary">(optional)</small></label>
                                <textarea wire:model="address" name="address" class="form-control form-control-sm" id="address" rows="2"></textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="etc">Keterangan lain <small class="text-secondary">(optional)</small></label>
                                <textarea wire:model="etc" name="etc" class="form-control form-control-sm" id="etc" rows="2"></textarea>
                                @error('etc') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="update()" class="btn btn-success btn-block btn-sm close-modal">Simpan</button>
            </div>
        </div>
        </div>
    </div>
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
