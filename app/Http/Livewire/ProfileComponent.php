<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileComponent extends Component
{
    public $password, $old_password, $password_confirmation;
    public $updateMode = false;
    public $name, $email, $user_id;
    public $user;

    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->user = User::where('id', $this->user_id)->first();
    }

    public function render()
    {
        return view('livewire.profile-component');
    }

    public function updateProfile()
    {
        $this->updateMode = true;
        $rules = [
            'name' => 'required|max:100|min:3',
        ];
        if ($this->user->email !== $this->email) {
            $rules['email'] = 'required|email|max:100|unique:users';
        }
        $validator = $this->validate($rules);
        $this->user->update($validator);
        $this->updateMode = false;
        return redirect()->to('/profile')->with('success', 'Profil berhasil diubah');
    }

    public function updatePassword()
    {
        $user = auth()->user();
        $this->updateMode = true;
        $this->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($this->old_password, $user->password)) {
                        $fail('The old password does not match');
                    }
                }
            ],
            'password' => 'required|min:8|required_with:password_confirmation|different:old_password',
            'password_confirmation' => 'required|same:password'
        ]);
        $password = bcrypt($this->password);
        $this->user->update(['password' => $password]);
        $this->updateMode = false;
        return redirect()->to('/profile')->with('success', 'Password berhasil diubah');
    }
}
