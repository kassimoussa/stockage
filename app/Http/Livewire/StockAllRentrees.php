<?php

namespace App\Http\Livewire;

use App\Models\Rentree;
use Carbon\Carbon;
use Livewire\Component;

class StockAllRentrees extends Component
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
                $this->cnts[$i] = Rentree::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereMonth('date_rentree', $i)->count();

                $this->results[$i] = Rentree::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereMonth('date_rentree', $i)->orderby('date_rentree', 'desc')->get();
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $this->cnts[$i] = Rentree::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereYear('date_rentree', $annex)->whereMonth('date_rentree', $i)->count();

                $this->results[$i] = Rentree::where('direction', $this->dir)->where('service', $this->service)->where('site', $this->site)->whereYear('date_rentree', $annex)->whereMonth('date_rentree', $i)->orderby('date_rentree', 'desc')->get();
            } 
        }
        $stocks = [
            'cnts' => $this->cnts,
            'results' => $this->results,
        ];

        return view('livewire.stock-all-rentrees', $stocks);
    }
}
