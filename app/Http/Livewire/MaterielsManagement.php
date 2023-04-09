<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Marque;
use App\Models\Materiel;
use App\Models\Models;
use App\Models\SortieMateriel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MaterielsManagement extends Component
{
    use WithFileUploads;

    public $site, $direction, $service, $submitedby, $materiels, $models, $marques, $categories;
    public $materiel_id, $category_id, $marque_id, $model_id, $num_patrimoine, $status, $filename;
    public $category_id2, $marque_id2, $model_id2, $num_patrimoine2, $filename2, $filename3, $url, $imgUrl;
    public $raison, $date_sortie, $audj;
    public $search = "";


    public function mount($site)
    {
        $this->audj = Carbon::today()->format('Y-m-d');
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service');
        $this->submitedby = session('username');
        $this->url = "images/addphoto.png";
        $this->imgUrl = "";
    }

    protected $rules = [
        'num_patrimoine' => 'required|unique:materiels',
    ];

    protected $messages = [
        'num_patrimoine.unique' => 'Ce numéro de patrimoine est déja enregistré dans la base de données !',
    ];

    public function getCategories()
    {
        $this->categories = Category::orderBy("name", "asc")->get();
    }

    public function getMarques()
    {
        if ($this->category_id == null) {
            $this->marques = Marque::orderBy("name", "asc")->get();
        } else {
            $this->marques = Marque::whereHas('categories', function ($query) {
                $query->where('category_id', $this->category_id);
            })->orderBy("name", "asc")->get();
        }
    }

    public function getModels()
    {
        if ($this->marque_id == null) {
            $this->models = Models::orderBy("name", "asc")->get();
        } else {
            $this->models = Models::where('marque_id', $this->marque_id)->orderBy("name", "asc")->get();
        }
    }

    public function close_modal()
    {
        $this->reset([
            'category_id', 'category_id2', 'marque_id', 'marque_id2', 'model_id', 'model_id2', 'num_patrimoine', 'num_patrimoine2', 'filename', 'filename2', 'raison', 'date_sortie'
        ]);
        $this->url = "images/addphoto.png";
    }

    public function getMateriels()
    {
        $this->materiels = Materiel::where('num_patrimoine', 'Like', '%' . $this->search . '%')
            ->with('category')->with('marque')
            ->with('model')
            ->where('direction', $this->direction)
            ->where('service', $this->service)
            ->where('site', $this->site)
            ->where('status', "yes")
            ->orderBy("num_patrimoine", "asc")
            ->get();
    }


    public function store()
    {
        /* $this->validate([
            'num_patrimoine' => 'required|unique:materiels',
        ]); */

        $materiel = new Materiel();
        $materiel->category_id = $this->category_id;
        $materiel->marque_id = $this->marque_id;
        $materiel->model_id = $this->model_id;
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

    public function update()
    {
        $materiel = Materiel::find($this->materiel_id);
        if ($this->filename2 != $materiel->filename) {
            $image_name = time() . '.' . $this->filename2->getClientOriginalName();
            $public_path = "public/images/" . $image_name;
            $storage_path = "storage/images/" . $image_name;
            $this->filename2->storeAs('public/images', $image_name);
            if ($materiel->public_path != null) {
                Storage::delete($materiel->public_path);
            }
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
                'category_id' => $this->category_id2,
                'marque_id' => $this->marque_id2,
                'model_id' => $this->model_id2,
                'filename' => $image_name,
                'public_path' => $public_path,
                'storage_path' => $storage_path,
            ]);
        } else {
            $query = $materiel->update([
                'num_patrimoine' => $this->num_patrimoine2,
                'category_id' => $this->category_id2,
                'marque_id' => $this->marque_id2,
                'model_id' => $this->model_id2,
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

    public function loadid($materiel_id)
    {
        $this->materiel_id = $materiel_id;
        $materiel = Materiel::find($materiel_id);
        $this->category_id2 = $materiel->category_id;
        $this->marque_id2 = $materiel->marque_id;
        $this->model_id2 = $materiel->model_id;
        $this->num_patrimoine2 = $materiel->num_patrimoine;
        $this->filename2 = $materiel->filename;
        $this->filename3 = $materiel->filename;
        if ($materiel->storage_path != null) {
            $this->url = $materiel->storage_path;
        } else {
            $this->url = "images/addphoto.png";
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

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
        $materiel = Materiel::find($materiel_id);
        $this->imgUrl = $materiel->storage_path;
    }

    public function close_img()
    {
        $this->imgUrl = "";
    }


    public function delete()
    {
        $materiel = Materiel::find($this->materiel_id);
        $materiel->delete();
        $this->getMateriels();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function sortie()
    {

        $sortie = new SortieMateriel();
        $sortie->category_id = $this->category_id2;
        $sortie->marque_id = $this->marque_id2;
        $sortie->model_id = $this->model_id2;
        $sortie->materiel_id = $this->materiel_id;
        $sortie->num_patrimoine = $this->num_patrimoine2;
        $sortie->raison = $this->raison;
        $sortie->date_sortie = $this->date_sortie;
        $sortie->direction = $this->direction;
        $sortie->service = $this->service;
        $sortie->site = $this->site;
        $sortie->submitedby = $this->submitedby;
        $query = $sortie->save();
        if ($query) {
            $materiel = Materiel::find($this->materiel_id);
            $query2 = $materiel->update([
                'status' => "no",
            ]);
            if ($query2) {
                $this->close_modal();
                $this->getMateriels();
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => 'Sortie réussie !']
                );
                $this->dispatchBrowserEvent('close-modal');
            } else {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'error',  'message' => "Erreur lors de la sortie !"]
                );
                $this->dispatchBrowserEvent('close-modal');
            }
        } else {

            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de la sortie !"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function render()
    {
        $this->getMateriels();
        $this->getModels();
        $this->getCategories();
        $this->getMarques();
        return view('livewire.materiels-management');
    }
}
