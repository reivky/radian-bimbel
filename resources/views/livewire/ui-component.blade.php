<div>

<div class="card shadow mb-4">
    <div class="card-body">
    
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible small fade show p-2" role="alert">
            {{ session('success') }}
            <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <div class="row mb-2">
            <div class="col-md-6 mb-3">
                <form>
                    <div class="form-group">
                        <label for="tagline" class="font-weight-bold text-primary text-center">Tag Line</label>
                        <textarea wire:model="tagline" class="form-control mb-2 @error('tagline') is-invalid @enderror" name="tagline" id="tagline" rows="3">
                        </textarea>
                        @error('tagline')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-inline">
                        <button wire:click.prevent="updateTagline()" type="button" class="btn btn-sm btn-success">Simpan</button>
                        <button wire:click.prevent="resetTagline()" type="button" class="btn btn-sm btn-danger">Reset</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="about" class="font-weight-bold text-primary text-center">Profil Radian Bimbel</label>
                        <textarea wire:model="about" class="form-control mb-2  @error('about') is-invalid @enderror" name="about" id="about" rows="3"></textarea>
                        @error('about')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-inline">
                        <button wire:click.prevent="updateAbout()" type="button" class="btn btn-sm btn-success">Simpan</button>
                        <button wire:click.prevent="resetAbout()" type="button" class="btn btn-sm btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <form class="mt-3">
            <div class="form-group">
                <label for="area" class="font-weight-bold text-primary text-center">Area</label><small class="text-secondary"> (pisahkan dengan tanda koma)</small>
                <input wire:model="area" type="text" class="form-control form-control-sm mb-2  @error('area') is-invalid @enderror">
                @error('area')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-inline">
                <button wire:click.prevent="updateArea()" type="button" class="btn btn-sm btn-success">Simpan</button>
                <button wire:click.prevent="resetArea()" type="button" class="btn btn-sm btn-danger">Reset</button>
            </div>
        </form>

    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header -->
    <div class="card-header py-3 d-flex flex-row text-center">
        <h6 class="m-0 font-weight-bold text-primary text-center">Gallery</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        @if (session()->has('gallery-success'))
        <div class="alert alert-success alert-dismissible small fade show p-2" role="alert">
            {{ session('gallery-success') }}
            <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        @endif
        @if (session()->has('gallery-failed'))
        <div class="alert alert-danger alert-dismissible small fade show p-2" role="alert">
            {{ session('gallery-failed') }}
            <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        @endif
        <form wire:submit.prevent="uploadGallery()" enctype="multipart/form-data" class="mt-3">
            <div class="input-group mb-1 image-form is-invalid">
                <div class="custom-file">
                    <label wire:ignore class="custom-file-label" for="gallery">Choose file</label>
                    <input wire:model="gallery" type="file" class="custom-file-input is-invalid" id="gallery"/>
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                </div>
            </div>
            @error('gallery')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </form>
        
        <div class="table-responsive mt-3">
            <table class="gambar" id="" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th width="10%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($galleries->total())
                    @foreach ($galleries as $gallery)
                    <tr>
                        <th>{{ ($galleries->currentpage()-1) * $galleries->perpage() + $loop->iteration }}</th>
                        <td><img class="mb-2" width="100px" src="/storage/gallery/{{ $gallery->img_gallery }}"></td>
                        <td>{{ $gallery->img_gallery }}</td><td class="action">
                            <a href="#" wire:click.prevent="deleteGallery({{ $gallery->id }})" title="hapus"><i class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if (!$galleries->total())
            <div class="text-center mt-2">Gambar Tidak Ada</div>
            @endif
            <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
            {{ $galleries->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header -->
    <div class="card-header py-3 d-flex flex-row text-center">
        <h6 class="m-0 font-weight-bold text-primary text-center">Testimonials</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        @if (session()->has('testimonial-success'))
        <div class="alert alert-success alert-dismissible small fade show p-2" role="alert">
            {{ session('testimonial-success') }}
            <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        @endif
        @if (session()->has('testimonial-failed'))
        <div class="alert alert-danger alert-dismissible small fade show p-2" role="alert">
            {{ session('testimonial-failed') }}
            <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        @endif
        <form wire:submit.prevent="uploadTestimonial()" enctype="multipart/form-data" class="mt-3">
            <div class="input-group mb-1 image-form is-invalid">
                <div class="custom-file">
                    <label wire:ignore class="custom-file-label" for="testimonial">Choose file</label>
                    <input wire:model="testimonial" type="file" class="custom-file-input is-invalid" id="testimonial"/>
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                </div>
            </div>
            @error('testimonial')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </form>
        
        <div class="table-responsive mt-3">
            <table class="gambar" id="" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th width="10%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($testimonials->total())
                    @foreach ($testimonials as $testimonial)
                    <tr>
                        <th>{{ ($testimonials->currentpage()-1) * $testimonials->perpage() + $loop->iteration }}</th>
                        <td><img class="mb-2" width="100px" src="/storage/testimonial/{{ $testimonial->img_testimonial }}"></td>
                        <td>{{ $testimonial->img_testimonial }}</td><td class="action">
                            <a href="#" wire:click.prevent="deleteTestimonial({{ $testimonial->id }})" title="hapus"><i class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if (!$testimonials->total())
            <div class="text-center mt-2">Gambar Tidak Ada</div>
            @endif
            <div class="mt-2 pagination-table pagination-sm d-flex justify-content-center">
            {{ $testimonials->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</div>


</div>
