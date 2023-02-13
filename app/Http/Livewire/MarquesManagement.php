<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Marque;
use Livewire\Component;

class MarquesManagement extends Component
{

    public $site, $direction, $service, $marques, $allCategories;
    public $marque_id, $category_id, $name, $category_id2, $name2;
    public $search = "";
    public $categories = [];
    public $selected_categories = [];

    
    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service'); 
        $this->allCategories = Category::orderBy("name", "asc")->get(); 
    }

    public function close_modal()
    {
        $this->reset([
            'marque_id', 'category_id', 'category_id2', 'name', 'name2', 'categories', 'selected_categories'
        ]);
    }



    public function getMarques()
    {
        $this->marques = Marque::where('name', 'Like', '%' . $this->search . '%')-> 
        with('categories')->
        with('models')->
        with('materiels')->
        orderBy("name", "asc")->get(); 

    }

    public function store()
    {
        $marque = new Marque();
        $marque->name = $this->name;
        $query = $marque->save();

        if ($query) {
            $marque->categories()->sync($this->categories);
            $this->close_modal();
            $this->getMarques();
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
        $marque = Marque::find($this->marque_id);
        $query = $marque->update([
            'name' => $this->name2,
        ]);
        if ($query) {
            $marque->categories()->sync($this->selected_categories);
            $this->close_modal();
            $this->getMarques();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Modification réussie !']
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

    public function attach()
    { 
        //dump($this->categories);
         $marque = Marque::find($this->marque_id);
         $marque->categories()->sync($this->selected_categories);
        $this->getMarques();
        $this->close_modal();
    }

    public function loadid($marque_id)
    {
        $this->marque_id = $marque_id;
        $marque = Marque::with("categories")->find($marque_id);
        $this->name2 = $marque->name; 
        $this->selected_categories = $marque->categories->pluck('id');
        //dump($this->selected_categories);
    }

    
    public function delete()
    {
        $marque = Marque::find($this->marque_id);
        $marque->categories()->detach();
        $marque->delete(); 
        $this->getMarques();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function render()
    {
        $this->getMarques();
        return view('livewire.marques-management');
    }
}
