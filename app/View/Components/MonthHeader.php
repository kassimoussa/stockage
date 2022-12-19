<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MonthHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $moisc, $moisl, $cnts, $i; 

    public function __construct($moisc, $moisl, $cnts, $i)
    {
        $this->moisc = $moisc ;
        $this->moisl = $moisl ;
        $this->cnts = $cnts ;
        $this->i = $i ;
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
