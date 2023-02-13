<?php

namespace App\Http\Livewire;

use App\Models\Listeobjet;
use Livewire\Component;

class GestionObjet2 extends Component
{
    public  $site, $direction, $service, $objets, $nom, $nom2, $objet_id, $w_obj; 
    public $search = "";

    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service'); 
    }

    
    public function close_modal()
    {
        $this->reset([
            'objet_id',
            'nom', 'nom2',
        ]);
    }

    public function getObjets()
    {
        $this->objets = Listeobjet::with('marmods')->
                                    with('materiels')->
                                    where('nom', 'Like', '%' . $this->search . '%')->
                                    orderBy("nom", "asc")->get();
    }

    public function storeObjet()
    {
        $objet = new Listeobjet();
        $objet->nom = $this->nom;
        $query = $objet->save();

        if ($query) {
            $this->close_modal();
            $this->getObjets();
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

    public function updateObjet()
    {
        $objet = Listeobjet::find($this->objet_id);
        $query = $objet->update([
            'nom' => $this->nom2,
        ]);
        if ($query) {
            $this->close_modal();
            $this->getObjets();
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

    public function loadid($objet_id)
    {
        $this->objet_id = $objet_id;
        $objet = Listeobjet::find($objet_id);
        $this->nom2 = $objet->nom; 
    }

    
    public function deleteObjet()
    {
        $objet = Listeobjet::find($this->marmod_id); 
        $objet->delete(); 
        $this->getObjets();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function render()
    {
        $this->getObjets();
        return view('livewire.gestion-objet2');
    }
}
