<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */ 
    public $delmodal, $message ; 
    public function __construct($delmodal, $message )
    {
        $this->delmodal = $delmodal ;
        $this->message = $message ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-modal');
    }
}
