<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class StudentComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $phone, $program, $lesson, $city, $study_level;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public $updateMode = false;
    public $paginate = 5;

    public function render()
    {
        return view('livewire.student-component', [
            'students' => $this->search ? Student::latest()->where('name', 'like', '%' . $this->search . '%')->orWhere('city', 'like', '%' . $this->search . '%')->orWhere('lesson', 'like', '%' . $this->search . '%')->orWhere('study_level', 'like', '%' . $this->search . '%')->orWhere('program', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->paginate($this->paginate) : Student::latest()->paginate($this->paginate),
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
        Student::create($validatedDate);
        session()->flash('success', 'siswa baru berhasil ditambahkan');
        $this->resetInputFields();
        $this->emit('userStore'); // Close model to using to jquery
    }
    public function edit($id)
    {
        $updateMode = true;
        $data = Student::where('id', $id)->first();
        if ($data) {
            $this->user_id = $id;
            $this->name = $data->name;
            $this->phone = $data->phone;
            $this->city = $data->city;
            $this->study_level = $data->study_level;
            $this->program = $data->program;
            $this->lesson = $data->lesson;
        }
    }
    public function update()
    {
        if ($this->user_id) {
            $student = Student::find($this->user_id);
            if ($student) {
                if ($student->name == $this->name && $student->city == $this->city && $student->phone == $this->phone && $student->study_level == $this->study_level && $student->program == $this->program && $student->lesson == $this->lesson) {
                    $this->closeModal();
                    return false;
                }
                $validatedDate = $this->validate([
                    'name' => 'required|max:255',
                    'city' => 'required|max:100',
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
        $student = Student::where('id', $id)->first();
        if ($student) {
            $this->user_id = $id;
        }
    }
    public function destroy()
    {
        if ($this->user_id) {
            Student::where('id', $this->user_id)->delete();
            session()->flash('success', 'Data siswa berhasil dihapus');
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
        $this->study_level = null;
        $this->lesson = null;
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
