<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ToggleStock extends Component
{
    public $ftab, $tab1, $tab2, $tab3, $tab4, $tab5, $site;

    public function mount($site)
    {
        $this->site = $site;
        $this->ftab = 1; 
        $this->tab1 = "btn-dark";
        $this->tab2 = "btn-outline-dark "; 
        $this->tab3 = "btn-outline-dark "; 
        $this->tab4 = "btn-outline-dark ";
        $this->tab5 = "btn-outline-dark"; 
    }

    public function focus($i)
    {
        if ($i == 1) {
            $this->ftab = 1;
            $this->tab1 = "btn-dark "; 
            $this->tab2 = "btn-outline-dark "; 
            $this->tab3 = "btn-outline-dark "; 
            $this->tab4 = "btn-outline-dark ";
            $this->tab5 = "btn-outline-dark"; 
        } elseif ($i == 2) {
            $this->ftab = 2;
            $this->tab2 = "btn-dark "; 
            $this->tab1 = "btn-outline-dark"; 
            $this->tab3 = "btn-outline-dark"; 
            $this->tab4 = "btn-outline-dark ";
            $this->tab5 = "btn-outline-dark"; 
        } elseif ($i == 3) {
            $this->ftab = 3;
            $this->tab3 = "btn-dark "; 
            $this->tab1 = "btn-outline-dark"; 
            $this->tab2 = "btn-outline-dark"; 
            $this->tab4 = "btn-outline-dark ";
            $this->tab5 = "btn-outline-dark"; 
        } elseif ($i == 4) {
            $this->ftab = 4;
            $this->tab4 = "btn-dark "; 
            $this->tab1 = "btn-outline-dark"; 
            $this->tab2 = "btn-outline-dark"; 
            $this->tab3 = "btn-outline-dark"; 
            $this->tab5 = "btn-outline-dark"; 
        }elseif ($i == 5) {
            $this->ftab = 5;
            $this->tab5 = "btn-dark "; 
            $this->tab1 = "btn-outline-dark"; 
            $this->tab2 = "btn-outline-dark"; 
            $this->tab3 = "btn-outline-dark"; 
            $this->tab4 = "btn-outline-dark ";
        }
    }
    public function render()
    {
        return view('livewire.toggle-stock');
    }
}
