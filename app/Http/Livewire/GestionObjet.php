<?php

namespace App\Http\Livewire;

use App\Models\ListeMarMod;
use App\Models\Listeobjet;
use App\Models\MaterielsStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class GestionObjet extends Component
{
    use WithFileUploads;

    public  $site, $objets, $nom_obj, $nom_obj2, $objet_id, $w_obj;
    public  $marmods, $marque, $marque2, $model, $model2, $marmod_id, $quantite, $w_mod;
    public  $materiels, $num_patrimoine, $direction, $service, $status, $filename, $public_path, $storage_path, $materiel_id, $w_mat;
    public  $num_patrimoine2, $status2, $filename2, $public_path2, $storage_path2;
    public  $disposition, $status_obj, $status_mod, $status_mat, $url;
    public $selectedObjRowId, $selectedModRowId, $selectedMatRowId, $imgUrl;
    public $search = "";

    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service');
        $this->status_obj = "show";
        $this->status_mod = "hidden";
        $this->status_mat = "hidden"; //row-cols-md-1
        $this->disposition = "row-cols-md-1";
        $this->url = "images/addphoto.png";
        $this->imgUrl = "";
    }

    public function selectObjRow($rid)
    {
        $this->selectedObjRowId = $rid;
    }
    public function selectModRow($rid)
    {
        $this->selectedModRowId = $rid;
    }
    public function selectMatRow($rid)
    {
        $this->selectedMatRowId = $rid;
    }

    public function getObjets()
    {
        $this->objets = Listeobjet::where('nom', 'Like', '%' . $this->search . '%')->orderBy("nom", "asc")->get();
    }

    public function getMarmods($objet_id)
    {
        $this->objet_id = $objet_id;
        //$this->marmods = ListeMarMod::where('objet_id', $objet_id)->orderBy("marque", "asc")->get();
       /*  $this->marmods = DB::table('liste_mar_mods as marmod')
            ->join('materiels_stocks as mat', 'marmod.id', '=', 'mat.marmod_id')
            ->select('marmod.id as modid, marmod.*', DB::raw('count(mat.marmod_id) as quantite'))
            ->groupBy('marmod.id')
            ->get(); */

        $results = collect();
        $marmods = ListeMarMod::where('objet_id', $objet_id)->orderBy("marque", "asc")->get();
        foreach ($marmods as $marmod) { 
            $quantite = MaterielsStock::where('direction', $this->direction)->where('service', $this->service)->where('site', $this->site)->where('marmod_id', $marmod->id)->count(); 
            $results->push([
                'id' => $marmod->id, 
                'marque' => $marmod->marque, 
                'model' => $marmod->model, 
                'quantite' => $quantite, 
            ]);
        }
        $this->marmods = $results;
        $this->disposition = "row-cols-md-2";
        $this->status_mod = "show";
        $this->status_mat = "hidden";
    }

    public function getMateriels($marmod_id)
    {
        $this->marmod_id = $marmod_id;
        $this->materiels = MaterielsStock::where('direction', $this->direction)->where('service', $this->service)->where('site', $this->site)->where('marmod_id', $marmod_id)->orderBy("num_patrimoine", "asc")->get();
        $this->disposition = "row-cols-md-3";
        $this->status_mat = "show";
    }

    public function close_modal()
    {
        $this->reset([
            'nom_obj', 'nom_obj2',
            'marque', 'marque2',
            'model', 'model2',
            'num_patrimoine', 'num_patrimoine2',
            'filename', 'filename2',
        ]);
        $this->url = "images/addphoto.png";
    }

    public function storeObjet()
    {
        $objet = new Listeobjet();
        $objet->nom = $this->nom_obj;
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

    public function storeMarmod()
    {
        $marmods = new ListeMarMod();
        $marmods->objet_id = $this->objet_id;
        $marmods->marque = $this->marque;
        $marmods->model = $this->model;
        $query = $marmods->save();

        if ($query) {
            $this->close_modal();
            $this->getMarmods($this->objet_id);
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
            $this->getMarmods($this->objet_id);
            $this->getMateriels($this->marmod_id);
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


    public function setObjetId($objet_id)
    {
        $this->objet_id = $objet_id;
    }

    public function getObjet($objet_id)
    {
        $this->objet_id = $objet_id;
        $objet = Listeobjet::find($objet_id);
        $this->nom_obj2 = $objet->nom;
    }

    public function setMarModId($marmod_id)
    {
        $this->marmod_id = $marmod_id;
    }

    public function getMarMod($marmod_id)
    {
        $this->marmod_id = $marmod_id;
        $marmod = ListeMarMod::find($marmod_id);
        $this->marque2 = $marmod->marque;
        $this->model2 = $marmod->model;
    }

    public function setMaterielId($materiel_id)
    {
        $this->materiel_id = $materiel_id;
    }

    public function getMateriel($materiel_id)
    {
        $this->materiel_id = $materiel_id;
        $materiel = MaterielsStock::find($materiel_id);
        $this->num_patrimoine2 = $materiel->num_patrimoine;
        $this->url = $materiel->storage_path;
    }

    public function updateObjet()
    {
        $objet = Listeobjet::find($this->objet_id);
        $query = $objet->update([
            'nom' => $this->nom_obj2,
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

    public function updateMarmod()
    {
        $marmod = ListeMarMod::find($this->marmod_id);
        $query = $marmod->update([
            'marque' => $this->marque2,
            'model' => $this->model2,
        ]);
        if ($query) {
            $this->close_modal();
            $this->getMarmods($this->objet_id);
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

    public function updateMateriel()
    {
        $materiel = MaterielsStock::find($this->materiel_id);

        if ($this->filename2 != $this->url) {
            $image_name = time() . '.' . $this->filename2->getClientOriginalName() . $this->filename2->extension();
            $public_path = "public/images/" . $image_name;
            $storage_path = "storage/images/" . $image_name;
            $this->filename2->storeAs('public/images', $image_name);
            if ($materiel->public_path != null) {
                Storage::delete($materiel->public_path);
            }
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
                'filename' => $image_name,
                'public_path' => $public_path,
                'storage_path' => $storage_path,
            ]);
        } else {
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
            ]);
        }

        if ($query) {
            $this->close_modal();
            $this->getMateriels($this->marmod_id);
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

    public function deleteMateriel()
    {
        $materiel = MaterielsStock::find($this->materiel_id);
        if ($materiel->public_path != null) {
            Storage::delete($materiel->public_path);
        }
        $materiel->delete();
        $this->getMateriels($this->marmod_id);

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function updated()
    {
        if ($this->filename) {
            $this->url =  $this->filename->temporaryUrl();
        }
        if ($this->filename2) {
            $this->url =  $this->filename2->temporaryUrl();
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
        $this->url = $materiel->storage_path;
    }

    public function render()
    {
        $this->getObjets();

        return view('livewire.gestion-objet');
    }
}
