<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowProduct extends Component
{
    public $showProductModal = false;

    public function showModel()
    {
        $this->showProductModal = true;
    }

   /*  public function render()
    {
        return view('livewire.show-product');
    } */
}
