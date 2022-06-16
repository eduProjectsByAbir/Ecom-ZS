<?php

namespace App\View\Components\Frontend\Header;

use Illuminate\View\Component;

class CategoryNav extends Component
{
    public $categories;
    
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.header.category-nav');
    }
}
