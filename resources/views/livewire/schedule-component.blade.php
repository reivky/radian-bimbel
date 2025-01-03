<div>

        <div class="card-header py-3">
            <a href="#" data-toggle="modal" data-target="#createModal" wire:click="resetInputFields()" class="btn btn-primary btn-sm">Tambah Jadwal Les</a>
        </div>
        <div class="card-body">
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
                            <th>Pengajar</th>
                            <th>Pelaksanaan</th>
                            <th>Lainnya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($schedules->total())
                        @foreach ($schedules as $key => $schedule)
                        <tr>
                            <th>{{ ($schedules->currentpage()-1) * $schedules->perpage() + $loop->iteration }}</th>
                            <td data-name="Nama">{{ $schedule->name }}</td>
                            <td data-name="Domisili">{{ $schedule->city }}</td>
                            <td data-name="Program Les">{{ $schedule->program }}</td>
                            <td data-name="Pengajar">{{ $schedule->teacher }}</td>
                            <td data-name="Pelaksanaan"class="schedule"><div class="datetime"><?php $date = date("d-m-Y", strtotime($schedule->date)); ?>{{ $date }} 
                                </div>
                                <div class="baris">{{ $schedule->time?$schedule->time.' WIB':'' }} </div>
                                <div class="baris">{{ $schedule->duration }}</div>
                            </td>
                            <td data-name="Lainnya"><a data-toggle="modal" data-target="#detailModal" wire:click.prevent="detailSchedule({{ $schedule->id }})" href="#">Lihat</a>
                            </td>
                            <td class="action-end">
                                <a href="#" title="selesaikan" data-toggle="modal" data-target="#scheduleEndModal" wire:click="scheduleEnd({{ $schedule->id }})" class="btn btn-success btn-sm btn-end mr-2">selesaikan</a>
                                <a href="#" title="ubah" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $schedule->id }})"><i class="far fa-edit"></a></i>&nbsp;
                                <a href="#" title="hapus" data-toggle="modal" data-target="#deleteModal" wire:click="delete({{ $schedule->id }})"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if (!$schedules->total())
                <div class="text-center mt-2">Jadwal tidak ditemukan</div>
                @endif
                <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
                {{ $schedules->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    

    {{-- modal create --}}
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="color: black">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah jadwal Les </h5>
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
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->name }}">{{ $teacher->name }} - {{ $teacher->city }}</option>
                            @endforeach
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
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-block btn-sm close-modal">Simpan</button>
            </div>
        </div>
        </div>
    </div>
    {{-- modal jadwal selesai --}}
    <div wire:ignore.self class="modal fade" id="scheduleEndModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered delete-modal " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center mx-auto my-auto" id="exampleModalLabel">Apakah yakin jadwal selesai?</h5>
                </div>
                <div class="modal-body">
                    <p>Jadwal akan terhapus dan data murid akan bertambah</p>
                </div>
                <div class="row p-3">
                    <div class="col">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-sm btn-secondary btn-block" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col">
                        <button type="button" wire:click.prevent="newStudent()" class="btn btn-sm btn-success btn-block close-modal">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
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
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->name }}">{{ $teacher->name }} - {{ $teacher->city }}</option>
                            @endforeach
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
    {{-- modal detail --}}
    <div wire:ignore.self class="modal fade" id="detailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="color: black">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Info Lainnya</h5>
            <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table-bordered table-detail" style=" width: 100%; color: black; ">
                    @if ($this->user_id)
                        <tr>
                            <th width="200px">Jenjang Pendidikan</th>
                            <td>{{ $this->study_level?$this->study_level:'-' }}</td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td>{{ $this->lesson?$this->lesson:'-' }}</td>
                        </tr>
                        <tr>
                            <th>No WhatsApp</th>
                            <td>{{ $this->phone?$this->phone:'-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $this->address?$this->address:'-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan Lain</th>
                            <td>{{ $this->etc?$this->etc:'-' }}</td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

</div>
