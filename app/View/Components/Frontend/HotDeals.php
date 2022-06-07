<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class HotDeals extends Component
{
    public $hot_products;
    
    public function __construct($hot_products)
    {
        $this->hot_products = $hot_products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.hot-deals');
    }
}
