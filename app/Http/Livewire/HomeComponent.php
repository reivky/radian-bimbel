<?php

namespace App\Http\Livewire;

use App\Models\Registrant;
use Livewire\Component;

class HomeComponent extends Component
{
    public $user_id, $name, $phone, $program, $city, $message;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public $updateMode = false;

    public function render()
    {
        return view('livewire.home-component');
    }
    public function store()
    {
        $this->program = $this->program ? $this->program : 'Les Privat Offline';
        $validatedDate = $this->validate([
            'name' => 'required|max:150|min:3',
            'phone' => 'required|max:15|min:10',
            'program' => 'required',
            'city' => 'required|max:100|min:3',
            'message' => 'max:255'
        ]);
        $check_regisrant = Registrant::where('name', $this->name)->orWhere('phone', $this->phone)->first();
        if (!$check_regisrant) {
            $new_registrant = Registrant::create($validatedDate);
            if ($new_registrant) {
                session()->flash('success', 'Pendaftaran berhasil kami akan menghubungi anda melalui WhatsApp');
                $this->closeModal();
            } else {
                session()->flash('failed', 'Pendaftaran gagal silahkan mendaftar melalui WhatsApp');
                $this->closeModal();
            }
        } else {
            session()->flash('failed', 'Anda sudah pernah mendaftar, silahkan mendaftar melalui WhatsApp');
            $this->closeModal();
        }
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
