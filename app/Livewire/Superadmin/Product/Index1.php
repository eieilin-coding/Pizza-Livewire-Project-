<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class Index1 extends Component
{
    public $selectedCategory = 'dry-cakes'; // Default to dry cakes
    public $search = '';
    public $vegFilter = 'all'; // all, veg, non-veg

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => 'dry-cakes'],
        'vegFilter' => ['except' => 'all'],
    ];

    public function selectCategory($categorySlug)
    {
        $this->selectedCategory = $categorySlug;
    }

    public function render()
    {
        $categories = Category::whereIn('slug', ['dry-cakes', 'celebration-cakes', 'pastries', 'savouries'])
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedCategory);
                });
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->when($this->vegFilter !== 'all', function ($query) {
                $query->where('is_veg', $this->vegFilter === 'veg');
            })
            ->orderBy('name')
            ->get();

        return view('welcome', [
            'categories' => $categories,
            'products' => $products,
            'currentCategory' => Category::where('slug', $this->selectedCategory)->first(),
        ]);
    }
}

//  public function discount()
    // {
    //     $discount = Book::where('disc_price', '<', 6500)->paginate(8);
    //     return view('books.discountBooks', [
    //         'discount' => $discount,
    //     ]);
    // }

    // public function featured()
    // {
    //     $featured = Book::where('is_featured', 1)->paginate(8);
    //     return view('books.featuredBooks', [
    //         'featured' => $featured,
    //     ]);
    // }

    // public function new()
    // {
    //     $new = Book::where('created_at', '>=', Carbon::now()->subWeeks(2))->paginate(8);
    //     return view('books.newBooks', [
    //         'new' => $new,
    //     ]);
    // }