<?php

namespace App\Livewire\Superadmin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public $name;
    public $image; // temporary upload
    public $existingImage; // existing stored filename for edit
    public $categoryName;
    public $price;
    public $category_id;
    public $add_to_card = false;
    public $wishlist = false;
    public $product_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'add_to_card' => 'boolean',
        'wishlist' => 'boolean',
    ];

    public function render()
    {
        $this->authorize('view product');
        $products = Product::with('category')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->paginate);

        $categories = Category::orderBy('name')->get();

        return view('livewire.superadmin.product.index', [
            'title' => 'Products',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    // open create modal: reset fields
    public function create()
    {
        $this->authorize('create product');
        $this->resetValidation();
        $this->reset(['name', 'image', 'existingImage', 'price', 'category_id']);
    }

    public function store()
    {
        $this->authorize('create product');
        $this->validate(array_merge($this->rules, [
            'name' => 'required|min:3',
            'image' => 'required|image|max:2048', // 2MB
            'price' => 'required|min:0',
            'category_id' => 'required',
        ]));

        $originalName = $this->image->getClientOriginalName();
        $path = $this->image->storeAs('photos', $originalName, 'public');
        Product::create([
            'name' => $this->name,
            'image' => $path,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);
        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->authorize('edit product');
        $this->resetValidation();
        $product = Product::findOrFail($id);

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->existingImage = $product->image; // path like products/abc.jpg
        $this->price = $product->price;
        $this->category_id = $product->category_id;
    }

    public function update($id)
    {
        $this->authorize('edit product');
        $product = Product::findOrFail($this->product_id);

        $this->validate(array_merge($this->rules, [
            'image' => 'nullable|image|max:2048',
        ]));

        if ($this->image) {
            // delete old file if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $originalName = $this->image->getClientOriginalName();
            $path = $this->image->storeAs('photos', $originalName, 'public');
            $product->image = $path;
        }
        $product->name = $this->name;
        $product->price = $this->price;
        $product->category_id = $this->category_id;
        $product->save();

        $this->dispatch('closeEditModal');
        $this->reset(['name', 'category_id', 'image', 'existingImage', 'price', 'product_id']);
    }

    // prepare for deletion
    public function confirm($id)
    {
        $this->authorize('delete product');
        $product = Product::with('category')->findOrFail($id);

        $this->product_id    = $product->id;
        $this->name          = $product->name;
        $this->existingImage = $product->image;
        $this->category_id   = $product->category_id;
        $this->categoryName  = $product->category ? $product->category->name : '-';
        $this->price         = $product->price;

        $this->dispatch('openDeleteModal'); // optional if you use JS to open modal
    }

    public function destroy()
    {
        $this->authorize('delete product');
        $product = Product::findOrFail($this->product_id);

        // delete image file if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        $this->dispatch('closeDeleteModal'); // Livewire event to close modal

        $this->reset(['product_id', 'name', 'existingImage', 'category_id', 'categoryName', 'price']);
    }
}
