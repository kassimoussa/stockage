<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Listeobjet;
use App\Models\MaterielsStock;
use App\Models\ListeMarMod;


class GestionMarmod extends Component
{
    use WithFileUploads;

    public  $site, $direction, $service, $objets, $marmods, $materiels;
    public $objet_id, $marmod_id, $marque, $model, $objet_id2, $marque2, $model2;
    public $search = "";

    
    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service'); 
    }

    
    public function getMarmods()
    {
        $this->marmods = ListeMarMod::where('marque', 'Like', '%' . $this->search . '%')->
        orWhere('model', 'Like', '%' . $this->search . '%')->
        with('objet')->
        with('materiels')->
        orderBy("id", "desc")->get(); 

    }

    public function getObjets()
    {
        $this->objets = Listeobjet::orderBy("nom", "asc")->get();
    }

    
    public function close_modal()
    {
        $this->reset([
            'objet_id', 'objet_id2', 
            'marque', 'marque2',
            'model', 'model2',
        ]);
    }

    public function storeMarmod()
    {
        $marmods = new ListeMarMod();
        $marmods->objet_id = $this->objet_id;
        $marmods->marque = $this->marque;
        $marmods->model = $this->model;
        $query = $marmods->save();

        if ($query) {
            $this->close_modal();
            $this->getMarmods();
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

    public function updateMarmod()
    {
        $marmod = ListeMarMod::find($this->marmod_id);
        $query = $marmod->update([
            'marque' => $this->marque2,
            'model' => $this->model2,
            'objet_id' => $this->objet_id2,
        ]);
        if ($query) {
            $this->close_modal();
            $this->getMarmods();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Modification réussi!']
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


    public function loadid($marmod_id)
    {
        $this->marmod_id = $marmod_id;
        $marmod = ListeMarMod::find($marmod_id);
        $this->marque2 = $marmod->marque;
        $this->model2 = $marmod->model;  
        $this->objet_id2 = $marmod->objet_id;
    }

    public function deleteMarmod()
    {
        $marmod = ListeMarMod::find($this->marmod_id); 
        $marmod->delete(); 
        $this->getMarmods();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function render()
    {
        $this->getMarmods();
        return view('livewire.gestion-marmod');
    }
}
