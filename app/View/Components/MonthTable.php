<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MonthTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $moisc, $moisl, $results, $type, $i, $txt, $date; 

    public function __construct($moisc, $moisl, $results, $type, $i)
    {
        $this->moisc = $moisc ;
        $this->moisl = $moisl ;
        $this->results = $results ;
        $this->type = $type ;
        $this->i = $i ; 
        if ($type == 'rentree') {
            $this->txt = 'fournisseur';
            $this->date = "date_rentree";
        } else {
            $this->txt = 'raison';
            $this->date = "date_sortie";
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.month-table');
    }
}
