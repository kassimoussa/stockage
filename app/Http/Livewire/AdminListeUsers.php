<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminListeUsers extends Component
{
    public $dir, $service, $name, $username, $email, $password, $user_id, $level, $ed_name, $ed_username, $ed_email, $ed_password;
    public $search = "";

    public function mount()
    {
        $this->dir = session('direction');
        $this->service = session('service');
    }

    public function close_modal()
    {
        $this->reset(['name', 'username', 'email', 'password', 'ed_name', 'ed_username', 'ed_email', 'ed_password']);
    }

    public function storeuser()
    {
        $this->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:6', 
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->level = "1";
        $user->direction = $this->dir;
        $user->service = $this->service;
        $query = $user->save();
        if($query)
        {
            $this->users = User::where('direction', $this->dir)->where('service', $this->service)->where('name', 'Like', '%' . $this->search . '%')->get();
            $this->close_modal();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'User ajouté avec succès !']
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit_modal($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($this->user_id);
        $this->ed_name = $user->name;
        $this->ed_username = $user->username;
        $this->ed_email = $user->email;
        $this->ed_password = $user->password; 
    }

    public function update()
    { 
       $user = User::find($this->user_id);
       $query = $user->update([
            'name' => $this->ed_name,
            'username' => $this->ed_username,
            'email' => $this->ed_email,
            'password' => $this->ed_password,
        ]);
        
        if ($query) {
            $this->close_modal();
            $this->users = User::where('direction', $this->dir)->where('service', $this->service)->where('name', 'Like', '%' . $this->search . '%')->get();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Modif réussi!']
            );
            /* $this->dispatchBrowserEvent('close-modal'); */
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de la modif !"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delid($user_id)
    {
        $this->user_id = $user_id;
    }

    public function delete()
    {
        $user = User::find($this->user_id);
        $user->delete();
        $this->users = User::where('direction', $this->dir)->where('service', $this->service)->where('name', 'Like', '%' . $this->search . '%')->get();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'User supprimé avec succès!']
        );
    }

    public function render()
    {
        $this->users = User::where('direction', $this->dir)->where('service', $this->service)->where('name', 'Like', '%' . $this->search . '%')->get();

        $users = [
            'users' => $this->users,
        ];

        return view('livewire.admin-liste-users', $users);
    }
}
