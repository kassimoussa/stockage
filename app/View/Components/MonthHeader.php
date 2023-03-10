<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class MonthHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $moisc, $moisl, $cnts, $i; 

    public function __construct($moisl, $i)
    {
        $this->moisl = $moisl ;
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
        return view('components.month-header');
    }
}
