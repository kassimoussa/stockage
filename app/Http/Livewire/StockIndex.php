<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;

class StockIndex extends Component
{
    public $sites, $dir, $service, $nom_site ;

    public function mount()
    {
        $this->dir = session('direction');
        $this->service = session('service');
        $this->sites = Site::where('direction', $this->dir)->where('service', $this->service)->get();
    }

    public function close_modal()
    {
        $this->reset(['nom_site']);
    }

    public function storeSite()
    {
        $site = new Site();
        $site->nom_site = $this->nom_site;
        $site->direction = $this->dir;
        $site->service = $this->service;
        $query = $site->save();
        if ($query) {
            $this->close_modal();
            $this->sites = Site::where('direction', $this->dir)->where('service', $this->service)->get();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Ajout réussi!']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de l'ajout!"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }

    }

    public function render()
    {
        return view('livewire.stock-index');
    }
}
