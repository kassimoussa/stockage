<?php

namespace App\Http\Livewire;

use App\Models\ListeMateriel;
use App\Models\ListeModel;
use Livewire\Component;

class GestionModel extends Component
{
    public  $models, $model, $model2, $materiels, $materiel, $materiel2, $model_id;
    public $search = "";

    public function getModels()
    {
        $search = $this->search;
        $this->models = ListeModel::where(function ($query) use ($search) {
            $query->where('model', 'Like', '%' . $search . '%')
                ->orWhere('materiel', 'Like', '%' . $search . '%') ;
        })->orderby('model', 'desc')->get();

        $this->materiels = ListeMateriel::all();
    }

    public function close_modal()
    {
        $this->reset(['model', 'model2', 'materiel', 'materiel2']);
    }

    public function storeModel()
    {
        $model = new ListeModel();
        $model->model = $this->model; 
        $model->materiel = $this->materiel; 
        $query = $model->save();

        if ($query) {
            $this->close_modal();
            $this->getModels();
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

    public function loadid($model_id)
    {
        $this->model_id = $model_id;
        $model = ListeModel::find($this->model_id); 
        $this->model2 = $model->model;  
        $this->materiel2 = $model->materiel;  
    }

    public function delete()
    {
        $model = ListeModel::find($this->model_id); 
        $model->delete();
        $this->getModels();
        
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function edit()
    {
        $model = ListeModel::find($this->model_id); 
        $query = $model->update([
            'model' => $this->model2, 
            'materiel' => $this->materiel2, 
        ]); 
        if ($query) {
            $this->close_modal();
            $this->getModels();
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

    public function render()
    {
        $this->getModels();
        return view('livewire.gestion-model');
    }
}
