<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Student;
use Livewire\WithPagination;

class ScheduleComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $phone, $program, $city, $etc, $date, $time, $address, $teacher, $study_level, $lesson, $duration;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public $updateMode = false;
    public $paginate = 5;

    public function render()
    {
        return view('livewire.schedule-component', [
            'schedules' => $this->search ? Schedule::latest()->where('name', 'like', '%' . $this->search . '%')->orWhere('city', 'like', '%' . $this->search . '%')->orWhere('program', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->orWhere('date', 'like', '%' . $this->search . '%')->orWhere('etc', 'like', '%' . $this->search . '%')->orWhere('time', 'like', '%' . $this->search . '%')->orWhere('address', 'like', '%' . $this->search . '%')->orWhere('teacher', 'like', '%' . $this->search . '%')->orWhere('study_level', 'like', '%' . $this->search . '%')->orWhere('lesson', 'like', '%' . $this->search . '%')->orWhere('duration', 'like', '%' . $this->search . '%')->paginate($this->paginate) : Schedule::latest()->paginate($this->paginate),
            'teachers' => Teacher::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }
    public function store()
    {
        $teacher = Teacher::where('status', 1)->orderBy('name', 'ASC')->first();
        $this->teacher = $this->teacher ? $this->teacher : $teacher->name;
        $this->program = $this->program ? $this->program : 'Les Privat Offline';
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
        session()->flash('success', 'Jadwal les berhasil ditambahkan');
        $this->closeModal();
    }
    public function edit($id)
    {
        $updateMode = true;
        $data = Schedule::where('id', $id)->first();
        if ($data) {
            $this->user_id = $id;
            $this->name = $data->name;
            $this->city = $data->city;
            $this->phone = $data->phone;
            $this->program = $data->program;
            $this->study_level = $data->study_level;
            $this->lesson = $data->lesson;
            $this->date = $data->date;
            $this->time = $data->time;
            $this->duration = $data->duration;
            $this->teacher = $data->teacher;
            $this->address = $data->address;
            $this->etc = $data->etc;
        }
    }
    public function update()
    {
        if ($this->user_id) {
            $schedule = Schedule::find($this->user_id);
            if ($schedule) {
                if (
                    $schedule->name == $this->name &&
                    $schedule->city == $this->city &&
                    $schedule->phone == $this->phone &&
                    $schedule->study_level == $this->study_level &&
                    $schedule->program == $this->program &&
                    $schedule->lesson == $this->lesson &&
                    $schedule->date == $this->date &&
                    $schedule->time == $this->time &&
                    $schedule->duration == $this->duration &&
                    $schedule->teacher == $this->teacher &&
                    $schedule->address == $this->address &&
                    $schedule->etc == $this->etc
                ) {
                    $this->closeModal();
                    return false;
                }
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
                $schedule->update($validatedDate);
                session()->flash('success', 'Jadwal berhasil diubah');
                $this->closeModal();
            }
        }
    }
    public function scheduleEnd($id)
    {
        $data = Schedule::where('id', $id)->first();
        if ($data) {
            $this->user_id = $id;
            $this->name = $data->name;
            $this->city = $data->city;
            $this->phone = $data->phone;
            $this->program = $data->program;
            $this->study_level = $data->study_level;
            $this->lesson = $data->lesson;
            $this->teacher = $data->teacher;
        }
    }
    public function newStudent()
    {
        if ($this->user_id) {
            $new_student = [
                'name' => $this->name,
                'city' => $this->city,
                'phone' => $this->phone,
                'program' => $this->program,
                'study_level' => $this->study_level,
                'lesson' => $this->lesson
            ];
            Student::create($new_student);
            $add_student_teacher = Teacher::where('name', $this->teacher)->first();
            if ($add_student_teacher) {
                $new_student_totals = $add_student_teacher->student_totals + 1;
                $add_student_teacher->update(['student_totals' => $new_student_totals]);
            }
            Schedule::where('id', $this->user_id)->delete();
            session()->flash('success', 'Jadwal les berhasil diselesaikan');
            $this->closeModal();
        }
    }
    public function delete($id)
    {
        $schedule = Schedule::where('id', $id)->first();
        if ($schedule) {
            $this->user_id = $id;
        }
    }
    public function destroy()
    {
        if ($this->user_id) {
            Schedule::where('id', $this->user_id)->delete();
            session()->flash('success', 'Jadwal berhasil dihapus');
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
