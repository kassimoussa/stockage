<?php

namespace App\Http\Livewire;

use App\Models\Sortie;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StockSortie extends Component
{
    use WithFileUploads;

    public $stock, $stock_id, $sorties, $newimage, $url, $public_path, $newquantite, $raison, $date_sortie;

    public function mount(Stock $stock)
    {
        $this->stock = $stock;
        $this->stock_id = $stock->id;
        $this->url = $stock->storage_path;
        $this->public_path = $stock->public_path;
        $this->sorties = Sortie::where('id_stock', $this->stock_id)->orderby('date_sortie', 'desc')->get();
    }

    public function updated()
    {
        if ($this->newimage) {
            $this->url =  $this->newimage->temporaryUrl();
        }
    }

    public function updateImage()
    {
        if ($this->url != $this->newimage) {
            $image_name =  time() . '.' . $this->newimage->getClientOriginalName() . $this->newimage->extension();
            $photo = $image_name;
            $public_path = "public/images/" . $image_name;
            $storage_path = "storage/images/" . $image_name;
            $this->newimage->storeAs('public/images', $image_name);

            if ($this->public_path != null) {
                Storage::delete($this->public_path);
            }

            $stock = Stock::find($this->stock_id);

            $query = $stock->update([
                'filename' => $photo,
                'public_path' => $public_path,
                'storage_path' => $storage_path,
            ]);

            if ($query) {
                $this->stock = Stock::find($this->stock_id);
                $this->url = $this->stock->storage_path;
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => 'Modification réussie !']
                );
                $this->dispatchBrowserEvent('close-modal');
            } else {
                return back()->with('fail', "Erreur lors de la modification ");
            }
            $this->stock = $stock;
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de la modification !"]
            );
        }
    }

    public function close_modal()
    {
        $this->reset(['raison', 'newquantite', 'date_sortie']);
    }
    
    public function newSortie()
    {
        $stock = Stock::find($this->stock_id);
        $quantite = $stock->quantite - $this->newquantite;
        $sortie = new Sortie();
        $sortie->id_stock = $stock->id;
        $sortie->materiel = $stock->materiel;
        $sortie->quantite = $this->newquantite;
        $sortie->raison = $this->raison;
        $sortie->date_sortie = $this->date_sortie;
        $sortie->site = $stock->site;
        $sortie->direction = $stock->direction;
        $sortie->service = $stock->service;
        $sortie->submitedby = session('username');
        $query = $sortie->save();

        if ($query) {
            $stock->update(['quantite' => $quantite]);
            $this->sorties = Sortie::where('id_stock', $this->stock_id)->orderby('date_sortie', 'desc')->get();
            $this->stock = Stock::find($this->stock_id);
            $this->close_modal();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Sortie de base de données ajoutée !']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            return back()->with('fail', "Erreur lors de la sortie ");
        }
    }




    public function render()
    {
        return view('livewire.stock-sortie');
    }
}
