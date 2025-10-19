<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    public $path;
    public $type;

    public function __construct($path = null, $type = 'avatar')
    {
        $this->path = $path;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image');
    }
}
