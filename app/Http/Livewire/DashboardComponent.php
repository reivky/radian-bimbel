<?php

namespace App\Http\Livewire;

use App\Models\Registrant;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $teachers, $students, $registrants, $schedules;
    protected $listeners = [
        'declineRegistrant',
        'newSchedule'
    ];

    public function mount()
    {
        $this->teachers = Teacher::count();
        $this->students = Student::count();
        $this->registrants = Registrant::count();
        $this->schedules = Schedule::count();
    }

    public function render()
    {
        return view('livewire.dashboard-component');
    }

    public function declineRegistrant($decline)
    {
        $this->registrants = Registrant::count();
    }

    public function newSchedule($new_schedule)
    {
        $this->schedules = Schedule::count();
    }
}
