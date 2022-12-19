<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StockListe extends Component
{
    use WithFileUploads;

    public $sites, $dir, $service, $site, $materiel, $quantite, $filename, $stock_id, $stocks;
    public $search = "";

    public function mount($site)
    {
        $this->site = $site;
        $this->dir = session('direction');
        $this->service = session('service');
    }

    public function close_modal()
    {
        $this->reset(['materiel', 'quantite', 'filename']);
    }

    public function storeStock()
    {
        $stock = new Stock();
        $stock->materiel = $this->materiel;
        $stock->quantite = $this->quantite;
        $stock->site = $this->site;
        $stock->direction = $this->dir;
        $stock->service = $this->service;
        if ($this->filename) {
            $image_name = time() . '.' . $this->filename->getClientOriginalName() . $this->filename->extension();
            $stock->filename = $image_name;
            $stock->public_path = "public/images/" . $image_name;
            $stock->storage_path = "storage/images/" . $image_name;
            $this->filename->storeAs('public/images', $image_name);
        }
        $query = $stock->save();
        if ($query) {
            $this->close_modal();
            $this->stocks = Stock::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->where('materiel', 'Like', '%' . $this->search . '%')->get();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Ajout réussi!']
            );
            /* $this->dispatchBrowserEvent('close-modal'); */
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de l'ajout!"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delid($stock_id)
    {
        $this->stock_id = $stock_id;
    }

    public function delete()
    {
        $stock = Stock::find($this->stock_id);
        Storage::delete($stock->public_path);
        $stock->delete();
        $this->stocks = Stock::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->where('materiel', 'Like', '%' . $this->search . '%')->get();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Materiel supprimé du stock avec succès!']
        );
    }

    public function render()
    {
        $this->stocks = Stock::where('direction', $this->dir)
            ->where('service', $this->service)
            ->where('site', $this->site)
            ->where('materiel', 'Like', '%' . $this->search . '%')
            ->get();

        $stocks = [
            'stocks' => $this->stocks,
        ];
        return view('livewire.stock-liste', $stocks);
    }
}
