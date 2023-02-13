<?php

namespace App\Http\Livewire;

use App\Models\Rentree;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StockRentree extends Component
{
    use WithFileUploads;

    public $stock, $stock_id, $rentrees, $newimage, $url, $public_path, $newquantite, $fournisseur, $date_rentree;

    public function mount(Stock $stock)
    {
        $this->stock = $stock;
        $this->stock_id = $stock->id;
        $this->url = $stock->storage_path;
        $this->public_path = $stock->public_path;
        $this->rentrees = Rentree::where('id_stock', $this->stock_id)->orderby('date_rentree', 'desc')->get();
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
        $this->reset(['fournisseur', 'newquantite', 'date_rentree']);
    }

    public function newRentree()
    {
        $stock = Stock::find($this->stock_id);
        $quantite = $stock->quantite + $this->newquantite;
        $rentree = new Rentree();
        $rentree->id_stock = $stock->id;
        $rentree->materiel = $stock->materiel;
        $rentree->quantite = $this->newquantite;
        $rentree->fournisseur = $this->fournisseur;
        $rentree->date_rentree = $this->date_rentree;
        $rentree->site = $stock->site;
        $rentree->direction = $stock->direction;
        $rentree->service = $stock->service;
        $rentree->submitedby = session('username');
        $query = $rentree->save(); 

        if ($query) {
            $stock->update(['quantite' => $quantite]);
            $this->rentrees = Rentree::where('id_stock', $this->stock_id)->orderby('date_rentree', 'desc')->get();
            $this->stock = Stock::find($this->stock_id);
            $this->close_modal();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Rentree de materiel reussie !']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            return back()->with('fail', "Erreur lors de la rentrée ");
        }
    }


    public function render()
    {
        return view('livewire.stock-rentree');
    }
}
