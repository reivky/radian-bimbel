<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class RegistrantComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $phone, $program, $message, $city, $etc, $date, $time, $address, $teacher, $study_level, $lesson, $duration;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public $updateMode = false;
    public $paginate = 5;

    public function render()
    {
        return view('livewire.registrant-component', [
            'registrants' => $this->search ? Registrant::latest()->where('name', 'like', '%' . $this->search . '%')->orWhere('city', 'like', '%' . $this->search . '%')->orWhere('program', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->orWhere('message', 'like', '%' . $this->search . '%')->paginate($this->paginate) : Registrant::latest()->paginate($this->paginate),
            'teachers' => Teacher::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }
    public function store()
    {
        // $this->program = !$this->program ? 'Les Privat Offline' : $this->program;
        // $rules = [
        //     'name' => 'required|max:255',
        //     'city' => 'required:max:100',
        //     'phone' => 'required|max:255',
        //     'program' => 'required',
        //     'study_level' => 'required|max:255',
        //     'lesson' => 'required',
        // ];
        // $validatedDate = $this->validate($rules);
        // Registrant::create($validatedDate);
        // session()->flash('success', 'siswa baru berhasil ditambahkan');
        // $this->resetInputFields();
        // $this->emit('userStore'); // Close model to using to jquery
    }
    public function edit($id)
    {
        $updateMode = true;
        $data = Registrant::where('id', $id)->first();
        if ($data) {
            $this->user_id = $id;
            $this->name = $data->name;
            $this->phone = $data->phone;
            $this->city = $data->city;
            $this->program = $data->program;
        }
    }
    public function update()
    {
        $teacher = Teacher::where('status', 1)->orderBy('name', 'ASC')->first();
        $this->teacher = $this->teacher ? $this->teacher : $teacher->name;
        if ($this->user_id) {
            $validatedDate = $this->validate([
                'name' => 'required|max:255',
                'city' => 'required|max:100',
                'phone' => 'required|max:255',
                'program' => 'required',
                'study_level' => 'max:255',
                'lesson' => 'max:255',
                'date' => 'required',
                'time' => 'max:20',
                'duration' => 'max:20',
                'teacher' => 'required',
                'address' => 'max:255',
                'etc' => 'max:255',
            ]);
            Schedule::create($validatedDate);
            Registrant::where('id', $this->user_id)->delete();
            session()->flash('success', 'Pendaftar berhasil diterima dan jadwal les telah ditambahkan');
            $this->closeModal();
        }
    }
    public function delete($id)
    {
        $registrant = Registrant::where('id', $id)->first();
        if ($registrant) {
            $this->user_id = $id;
        }
    }
    public function destroy()
    {
        if ($this->user_id) {
            Registrant::where('id', $this->user_id)->delete();
            session()->flash('success', 'Data pendaftar berhasil ditolak');
            $this->closeModal();
        }
    }
    public function updatedsearch()
    {
        $this->resetPage();
    }
    public function resetInputFields()
    {
        $this->name = null;
        $this->city = null;
        $this->phone = null;
        $this->program = null;
        $this->message = null;
        $this->study_level = null;
        $this->lesson = null;
        $this->date = null;
        $this->time = null;
        $this->duration = null;
        $this->teacher = null;
        $this->address = null;
        $this->etc = null;
    }
    public function cancel()
    {
        $this->resetErrorBag();
        $this->updateMode = false;
        $this->resetInputFields();
    }
    public function closeModal()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->emit('userStore');
    }
}
