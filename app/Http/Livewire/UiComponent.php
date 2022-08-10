<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Gallery;
use Livewire\Component;
use App\Models\Components;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class UiComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tagline, $about, $area, $gallery, $testimonial;
    public $updateMode = false;

    public function mount()
    {
        $tagline = Components::where('type', 'tagline')->first();
        $about = Components::where('type', 'about')->first();
        $area = Components::where('type', 'area')->first();
        $this->tagline = $tagline ? $tagline->content : 'Layanan Les Privat Terpercaya Tentor Terbaik Datang Ke Rumah';
        $this->about = $about ? $about->content : 'Radian Bimbel adalah sebuah lembaga pendidikan yang berfokus pada bimbingan belajar di rumah atau les privat dengan tentor yang profesional. Kami akan memberikan jaminan kecocokan antara tentor atau pendamping belajar dengan anda.';
        $this->area = $area ? $area->content : 'Semarang, Demak, Kudus, Jepara';
    }

    public function render()
    {
        return view('livewire.ui-component', [
            'galleries' => Gallery::latest()->paginate(3),
            'testimonials' => Testimonial::latest()->paginate(3),
        ]);
    }

    public function updateTagline()
    {
        $this->updateMode = true;
        $this->validate([
            'tagline' => 'required|max:100|min:10'
        ]);
        $tagline = Components::where('type', 'tagline')->first();
        if ($tagline) {
            $tagline->update(['content' => $this->tagline]);
        } else {
            Components::create([
                'content' => $this->tagline,
                'type' => 'tagline'
            ]);
        }
        $this->updateMode = false;
        session()->flash('success', 'Data tagline telah berhasil diubah');
    }

    public function resetTagline()
    {
        $tagline = Components::where('type', 'tagline')->first();
        if ($tagline) {
            $tagline->delete();
        }
        $this->tagline = 'Layanan Les Privat Terpercaya Tentor Terbaik Datang Ke Rumah';
        $this->resetErrorBag();
        session()->flash('success', 'Data tagline telah berhasil direset');
    }

    public function updateAbout()
    {
        $this->updateMode = true;
        $this->validate([
            'about' => 'required|max:255|min:10'
        ]);
        $about = Components::where('type', 'about')->first();
        if ($about) {
            $about->update(['content' => $this->about]);
        } else {
            Components::create([
                'content' => $this->about,
                'type' => 'about'
            ]);
        }
        $this->updateMode = false;
        session()->flash('success', 'Data profil telah berhasil diubah');
    }

    public function resetAbout()
    {
        $about = Components::where('type', 'about')->first();
        if ($about) {
            $about->delete();
        }
        $this->about = 'Radian Bimbel adalah sebuah lembaga pendidikan yang berfokus pada bimbingan belajar di rumah atau les privat dengan tentor yang profesional. Kami akan memberikan jaminan kecocokan antara tentor atau pendamping belajar dengan anda.';
        $this->resetErrorBag();
        session()->flash('success', 'Data profil telah berhasil direset');
    }

    public function updateArea()
    {
        $this->updateMode = true;
        $this->validate([
            'area' => 'required|max:255|min:5'
        ]);
        $area = Components::where('type', 'area')->first();
        if ($area) {
            $area->update(['content' => $this->area]);
        } else {
            Components::create([
                'content' => $this->area,
                'type' => 'area'
            ]);
        }
        $this->updateMode = false;
        session()->flash('success', 'Data area telah berhasil diubah');
    }

    public function resetArea()
    {
        $area = Components::where('type', 'area')->first();
        if ($area) {
            $area->delete();
        }
        $this->area = 'Semarang, Demak, Kudus, Jepara';
        $this->resetErrorBag();
        session()->flash('success', 'Data area telah berhasil direset');
    }

    public function uploadGallery()
    {
        $this->validate([
            'gallery' => 'required|image|file|max:2048'
        ]);
        if (Gallery::count() == 10) {
            $this->gallery = null;
            session()->flash('gallery-failed', 'Gambar Gallery tidak boleh melebihi 10');
        } else {
            $filename = uniqid() . '_' . $this->gallery->getClientOriginalName();
            $this->gallery->storeAs('gallery', $filename);
            Gallery::create(['img_gallery' => $filename]);
            $this->gallery = null;
            $this->resetPage();
            session()->flash('gallery-success', 'Gambar berhasil ditambahkan');
        }
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::where('id', $id)->first();
        if (file_exists(public_path('storage/gallery/' . $gallery->img_gallery))) {
            unlink(public_path('storage/gallery/' . $gallery->img_gallery));
        } else {
            session()->flash('gallery-failed', 'Gagal Menghapus Gambar');
            return false;
        }
        $gallery->delete();
        session()->flash('gallery-success', 'Gambar berhasil dihapus');
    }

    public function uploadTestimonial()
    {
        $this->validate([
            'testimonial' => 'required|image|file|max:2048'
        ]);
        if (Testimonial::count() == 10) {
            $this->testimonial = null;
            session()->flash('testimonial-failed', 'Gambar Testimonial tidak boleh melebihi 10');
        } else {
            $filename = uniqid() . '_' . $this->testimonial->getClientOriginalName();
            $this->testimonial->storeAs('testimonial', $filename);
            Testimonial::create(['img_testimonial' => $filename]);
            $this->testimonial = null;
            $this->resetPage();
            session()->flash('testimonial-success', 'Gambar berhasil ditambahkan');
        }
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        if (file_exists(public_path('storage/testimonial/' . $testimonial->img_testimonial))) {
            unlink(public_path('storage/testimonial/' . $testimonial->img_testimonial));
        }
        $testimonial->delete();
        session()->flash('testimonial-success', 'Gambar berhasil dihapus');
    }
}
