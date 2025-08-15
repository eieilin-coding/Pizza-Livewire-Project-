<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class ProductsSection extends Component
{
     public $cakeProducts;
    public $cakeCategory;
    public $pastryProducts;
    public $pastryCategory;
    public $pizzaProducts;
    public $pizzaCategory;

    public function mount()
    {
        $this->loadProducts();
    }

     public function loadProducts()
    {
        $this->pizzaCategory = Category::where('name', 'Pizza')->first();
        $this->pizzaProducts = $this->pizzaCategory 
            ? $this->pizzaCategory->products()->take(8)->get() 
            : collect();

        // Load cake category and products
        $this->cakeCategory = Category::where('name', 'Cakes')->first();
        $this->cakeProducts = $this->cakeCategory 
            ? $this->cakeCategory->products()->take(8)->get() 
            : collect();

        // Load pastry category and products
        $this->pastryCategory = Category::where('name', 'Pastries')->first();
        $this->pastryProducts = $this->pastryCategory 
            ? $this->pastryCategory->products()->get() 
            : collect();
    }

    public function render()
    {
        return view('livewire.products-section');
    }
}
