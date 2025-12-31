<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemCard extends Component
{
    public $item;
    public string $mode;
    public ?int $orderId;
    public string $type;

    public function __construct($item, string $mode = 'default', ?int $orderId = null, string $type = 'items')
    {
        $this->item = $item;
        $this->mode = $mode;
        $this->orderId = $orderId;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-card');
    }
}
