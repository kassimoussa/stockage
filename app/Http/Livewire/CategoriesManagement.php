<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Marque;
use Livewire\Component;

class CategoriesManagement extends Component
{
    public  $site, $direction, $service, $categories, $name, $name2, $category_id, $allMarques; 
    public $search = "";
    public $selected_marques = [];

    public function mount($site)
    {
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service');
        $this->allMarques = Marque::orderBy("name", "asc")->get(); 
    }

    public function close_modal()
    {
        $this->reset([
            'category_id',
            'name', 'name2',
        ]);
    }

    public function getCategories()
    {
        $this->categories = Category::with('marques')->
                                    with('models')->
                                    with('materiels')->
                                    where('name', 'Like', '%' . $this->search . '%')->
                                    orderBy("name", "asc")->get();
        //dump($this->categories);
    }

    public function store()
    {
        $category = new Category();
        $category->name = $this->name;
        $query = $category->save();

        if ($query) {
            $this->close_modal();
            $this->getCategories();
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
        $category = Category::find($this->category_id);
        $query = $category->update([
            'name' => $this->name2,
        ]);
        if ($query) {
            $category->marques()->sync($this->selected_marques);
            $this->close_modal();
            $this->getCategories();
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

    public function loadid($category_id)
    {
        $this->category_id = $category_id;
        $category = Category::find($category_id);
        $this->name2 = $category->name; 
        $this->selected_marques = $category->marques->pluck('id');
    }

    
    public function delete()
    {
        $category = Category::find($this->category_id);
        $category->marques->detach();
        $category->delete(); 
        $this->getCategories();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }

    public function render()
    {
        $this->getCategories();
        return view('livewire.categories-management');
    }
}
