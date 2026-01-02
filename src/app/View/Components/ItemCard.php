<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Order;

class ItemCard extends Component
{
    public $item;
    public string $mode;
    public ?Order $order;
    public string $type;

    public function __construct($item, string $mode = 'default', ?Order $order = null, string $type = 'items')
    {
        $this->item = $item;
        $this->mode = $mode;
        $this->order = $order;
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
