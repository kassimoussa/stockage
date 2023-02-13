<?php

namespace App\Http\Livewire;

use App\Models\ListeMarMod;
use App\Models\ListeMateriel;
use App\Models\ListeModel;
use App\Models\Listeobjet;
use App\Models\MaterielsStock;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class GestionMateriel extends Component
{
    use WithFileUploads;
    public $site,  $direction, $service, $materiels, $marmods, $objets;
    public $objet_id, $marmod_id, $materiel_id, $num_patrimoine, $filename, $public_path, $storage_path, $url, $imgUrl;
    public $objet_id2, $marmod_id2, $materiel_id2, $num_patrimoine2, $filename2, $public_path2, $storage_path2, $filename3;
    public $search = "";

    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service');
        $this->url = "images/addphoto.png";
        $this->imgUrl = "";
    }

    public function getMateriels()
    {
        $this->materiels = MaterielsStock::with('objet')->
        with('marmod')->
        where('direction', $this->direction)->
        where('service', $this->service)->
        where('site', $this->site)->
        where('num_patrimoine', 'Like', '%' . $this->search . '%')->
        orderBy("id", "desc")->get(); 

    }

    public function getObjets()
    {
        $this->objets = Listeobjet::orderBy("nom", "asc")->get();
    }

    public function getMarmods()
    {
        if ($this->objet_id == null) {
            $this->marmods = ListeMarMod::orderBy("marque", "asc")->get();
        } else {
            $this->marmods = ListeMarMod::where('objet_id', $this->objet_id )->orderBy("marque", "asc")->get();
        }
    }

    public function close_modal()
    {
        $this->reset([
            'objet_id', 'objet_id2', 
            'marmod_id', 'marmod_id2',
            'num_patrimoine', 'num_patrimoine2',
            'filename', 'filename2',
        ]);
        $this->url = "images/addphoto.png";
    }

    public function storeMateriel()
    {
        $materiel = new MaterielsStock();
        $materiel->objet_id = $this->objet_id;
        $materiel->marmod_id = $this->marmod_id;
        $materiel->num_patrimoine = $this->num_patrimoine;
        $materiel->direction = $this->direction;
        $materiel->service = $this->service;
        $materiel->site = $this->site;
        if ($this->filename) {
            $image_name = time() . '.' . $this->filename->getClientOriginalName();
            $materiel->filename = $image_name;
            $materiel->public_path = "public/images/" . $image_name;
            $materiel->storage_path = "storage/images/" . $image_name;
            $this->filename->storeAs('public/images', $image_name);
        }
        $query = $materiel->save();

        if ($query) {
            $this->close_modal();
            $this->getMateriels();
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


    public function deleteMateriel()
    {
        $materiel = MaterielsStock::find($this->materiel_id);
        if ($materiel->public_path != null) {
            Storage::delete($materiel->public_path);
        }
        $materiel->delete();
        $this->getMateriels();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function updateMateriel()
    {
        $materiel = MaterielsStock::find($this->materiel_id);

        if ($this->filename2 != $materiel->filename) {
            $image_name = time() . '.' . $this->filename2->getClientOriginalName() . $this->filename2->extension();
            $public_path = "public/images/" . $image_name;
            $storage_path = "storage/images/" . $image_name;
            $this->filename2->storeAs('public/images', $image_name);
            if ($materiel->public_path != null) {
                Storage::delete($materiel->public_path);
            }
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
                'objet_id' => $this->objet_id2,
                'marmod_id' => $this->marmod_id2,
                'filename' => $image_name,
                'public_path' => $public_path,
                'storage_path' => $storage_path,
            ]);
        } else {
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
                'objet_id' => $this->objet_id2,
                'marmod_id' => $this->marmod_id2,
            ]);
        }

        if ($query) {
            $this->close_modal();
            $this->getMateriels();
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
    
    public function updated()
    {
        if ($this->filename) {
            $this->url =  $this->filename->temporaryUrl();
        }
        if ($this->filename2) {
            if ($this->filename2 != $this->filename3) {
                $this->url =  $this->filename2->temporaryUrl();
            }
        }
    }
    
    public function showImg($materiel_id)
    {
        $materiel = MaterielsStock::find($materiel_id);
        $this->imgUrl = $materiel->storage_path;
    }

    public function close_img()
    {
        $this->imgUrl = "";
    }

    public function loadid($materiel_id)
    {
        $this->materiel_id = $materiel_id;
        $materiel = MaterielsStock::find($materiel_id);
        $this->num_patrimoine2 = $materiel->num_patrimoine;
        $this->objet_id2 = $materiel->objet_id;
        $this->marmod_id2 = $materiel->marmod_id; 
        $this->filename2 = $materiel->filename; 
        $this->filename3 = $materiel->filename; 
        if($materiel->storage_path != null)
        {
            $this->url = $materiel->storage_path;
        } else {
            $this->url = "images/addphoto.png";
        }
    }



    public function render()
    {
        $this->getMateriels();
        $this->getObjets();
        $this->getMarmods();
        return view('livewire.gestion-materiel');
    }
}
