<?php

namespace App\Http\Livewire;

use App\Models\Sortie;
use Livewire\Component;
use Carbon\Carbon;

class StockAllSorties extends Component
{
    public $site, $annee, $mois, $dir, $service, $cnts, $results;
    public function mount($site)
    {
        $this->site = $site;
        $this->dir = session('direction');
        $this->service = session('service');
        $this->annee = Carbon::now()->format('Y');
        $this->mois = Carbon::now()->format('m');
    }
    public function render()
    {
        $annex = $this->annee;
        if ($annex == "all") {
            for ($i = 1; $i <= 12; $i++) {
                $this->cnts[$i] = Sortie::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereMonth('date_sortie', $i)->count();

                $this->results[$i] = Sortie::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereMonth('date_sortie', $i)->orderby('date_sortie', 'desc')->get();
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $this->cnts[$i] = Sortie::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereYear('date_sortie', $annex)->whereMonth('date_sortie', $i)->count();

                $this->results[$i] = Sortie::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereYear('date_sortie', $annex)->whereMonth('date_sortie', $i)->orderby('date_sortie', 'desc')->get();
            }
        }
        $stocks = [
            'cnts' => $this->cnts,
            'results' => $this->results,
        ];
        return view('livewire.stock-all-sorties', $stocks);
    }
}
