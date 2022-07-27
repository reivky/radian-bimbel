<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use App\Models\Registrant;
use Livewire\WithPagination;

class RegistrantComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $phone, $program, $message, $city, $day, $etc, $date, $time, $address, $teacher;
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
        $this->program = !$this->program ? 'Les Privat Offline' : $this->program;
        $rules = [
            'name' => 'required|max:255',
            'city' => 'required:max:100',
            'phone' => 'required|max:255',
            'program' => 'required',
            'study_level' => 'required|max:255',
            'lesson' => 'required',
        ];
        $validatedDate = $this->validate($rules);
        Registrant::create($validatedDate);
        session()->flash('success', 'siswa baru berhasil ditambahkan');
        $this->resetInputFields();
        $this->emit('userStore'); // Close model to using to jquery
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
        if ($this->user_id) {
            $student = Registrant::find($this->user_id);
            if ($student) {
                if ($student->name == $this->name && $student->city == $this->city && $student->phone == $this->phone && $student->study_level == $this->study_level && $student->program == $this->program && $student->lesson == $this->lesson) {
                    $this->closeModal();
                    return false;
                }
                $validatedDate = $this->validate([
                    'name' => 'required|max:255',
                    'city' => 'required:max:100',
                    'phone' => 'required|max:255',
                    'program' => 'required',
                    'study_level' => 'required|max:255',
                    'lesson' => 'required',
                ]);
                $student->update($validatedDate);
                session()->flash('success', 'Data siswa berhasil diubah');
                $this->closeModal();
            }
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
