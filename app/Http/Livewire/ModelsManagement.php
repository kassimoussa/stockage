<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Marque;
use App\Models\Models;
use Livewire\Component;

use function Ramsey\Uuid\v1;

class ModelsManagement extends Component
{

    public $site, $direction, $service, $models, $marques, $categories, $marques2;
    public $model_id, $category_id, $marque_id, $name, $category_id2, $marque_id2, $name2;
    public $search = "";

    
    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service'); 
    }

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

    public function close_modal()
    {
        $this->reset([
            'model_id', 'category_id', 'category_id2', 'marque_id', 'marque_id2', 'name', 'name2',
        ]);
    }

    public function getModels()
    {
        $this->models = Models::where('name', 'Like', '%' . $this->search . '%')-> 
        with('category')->
        with('marque')-> 
        with(['materiels' => function ($query) {
            $query->where('status', 'yes');
        }])->
        orderBy("name", "asc")->get(); 

    }

    public function store()
    {
        $model = new Models();
        $model->category_id = $this->category_id;
        $model->marque_id = $this->marque_id;
        $model->name = $this->name;
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

    public function update()
    {
        $model = Models::find($this->model_id);
        $query = $model->update([
            'category_id' => $this->category_id2,
            'marque_id' => $this->marque_id2,
            'name' => $this->name2,
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

    public function loadid($model_id)
    {
        $this->model_id = $model_id;
        $model = Models::find($model_id);
        $this->category_id2 = $model->category_id; 
        $this->marque_id2 = $model->marque_id; 
        $this->name2 = $model->name; 
    }

    
    public function delete()
    {
        $model = Models::find($this->model_id);
        $model->delete(); 
        $this->getModels();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function render()
    {
        $this->getModels();  
        $this->getCategories(); 
        $this->getMarques(); 
        return view('livewire.models-management');
    }
}
