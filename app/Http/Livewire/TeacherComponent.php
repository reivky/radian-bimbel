<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $phone, $status = 1, $city, $student_totals;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public $updateMode = false;
    public $paginate = 5;

    public function render()
    {
        return view('livewire.teacher-component', [
            'teachers' => $this->search ? Teacher::latest()->where('name', 'like', '%' . $this->search . '%')->orWhere('city', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->paginate($this->paginate) : Teacher::latest()->paginate($this->paginate),
        ]);
    }
    public function store()
    {
        $rules = [
            'name' => 'required|max:255',
            'city' => 'required:max:100',
            'phone' => 'required|max:255',
            'status' => 'required',
        ];
        if ($this->student_totals) {
            $rules['student_totals'] = 'required|max:255';
        }
        $validatedDate = $this->validate($rules);
        Teacher::create($validatedDate);
        session()->flash('success', 'Pengajar baru berhasil ditambahkan');
        $this->resetInputFields();
        $this->emit('userStore'); // Close model to using to jquery
    }
    public function edit($id)
    {
        $updateMode = true;
        $data = Teacher::where('id', $id)->first();
        if ($data) {
            $this->user_id = $id;
            $this->name = $data->name;
            $this->phone = $data->phone;
            $this->city = $data->city;
            $this->student_totals = $data->student_totals;
            $this->status = $data->status;
        }
    }
    public function update()
    {
        if ($this->user_id) {
            $teacher = Teacher::find($this->user_id);
            if ($teacher) {
                if ($teacher->name == $this->name && $teacher->city == $this->city && $teacher->phone == $this->phone && $teacher->student_totals == $this->student_totals && $teacher->status == $this->status) {
                    $this->closeModal();
                    return false;
                }
                $validatedDate = $this->validate([
                    'name' => 'required|max:255',
                    'city' => 'required|max:100',
                    'phone' => 'required|max:15',
                    'student_totals' => 'required|max:5',
                    'status' => 'required',
                ]);
                $teacher->update($validatedDate);
                session()->flash('success', 'Data pengajar berhasil diubah');
                $this->closeModal();
            }
        }
    }
    public function delete($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        if ($teacher) {
            $this->user_id = $id;
        }
    }
    public function destroy()
    {
        if ($this->user_id) {
            Teacher::where('id', $this->user_id)->delete();
            session()->flash('success', 'Data pengajar berhasil dihapus');
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
        $this->student_totals = null;
        $this->status = 1;
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
