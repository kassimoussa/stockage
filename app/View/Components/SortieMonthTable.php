<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;

class SortieMonthTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $moisl, $results, $i, $moisc; 

    public function __construct($moisl, $i, $results)
    {
        $this->moisl = $moisl ;
        $this->results = $results ;
        $this->i = $i ;
        $this->moisc = Carbon::now()->format('m');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sortie-month-table');
    }
}
