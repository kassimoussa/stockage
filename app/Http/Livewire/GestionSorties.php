<?php

namespace App\Http\Livewire;

use App\Models\Materiel;
use App\Models\SortieMateriel;
use Livewire\Component;
use Carbon\Carbon;

class GestionSorties extends Component
{
    public $site, $moisc, $annex, $direction, $service, $submitedby, $sorties, $models, $marques, $categories, $url, $imgUrl;

    public function mount($site)
    {
        $this->annex = Carbon::now()->format('Y');
        $this->moisc = Carbon::now()->format('m');
        $this->site = $site;
        $this->direction = session('direction');
        $this->service = session('service');
        $this->submitedby = session('username'); 
    }



    public function getSorties()
    {
        for ($j = 1; $j <= 12; $j++) {
            $this->sorties[$j] = SortieMateriel::whereYear('date_sortie', $this->annex)->whereMonth('date_sortie', $j)
                ->with('category')
                ->with('marque')
                ->with('model')
                ->with('materiel')
                ->where('direction', $this->direction)
                ->where('service', $this->service)
                ->where('site', $this->site)
                ->orderBy("created_at", "desc")
                ->get();
        }

        //dd($this->sorties);
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

    public function render()
    {
        $this->getSorties();

        return view('livewire.gestion-sorties');
    }
}
