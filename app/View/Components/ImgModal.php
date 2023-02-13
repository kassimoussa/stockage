<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImgModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $imgmodal, $imgurl;
    public function __construct($imgmodal, $imgurl)
    {
        $this->imgmodal = $imgmodal ;
        $this->imgurl = $imgurl ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.img-modal');
    }
}
