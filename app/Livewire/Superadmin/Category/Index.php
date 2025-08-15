<?php

namespace App\Livewire\Superadmin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';

    public $name, $category_id;

    public function render()
    {
        $this->authorize('view category');
        $data = array(
            'title' => 'Data Category',
            'category' => Category::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('name', 'ASC')->paginate($this->paginate)
        );
        return view('livewire.superadmin.category.index', $data);
    }

    public function create()
    {
        $this->authorize('create category');
        $this->resetValidation();
        $this->reset('name');
    }

    public function store()
    {
        $this->authorize('create category');
        $this->validate(
            [
                'name' => 'required|unique:categories,name'
            ],
            ['name.required' => 'The name is required.',]
        );
        $category = new Category();
        $category->name = $this->name;

        $category->save();

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->authorize('edit category');
        $this->resetValidation();
        $category = Category::findOrFail($id);
        $this->name = $category->name;
        $this->category_id = $category->id;
    }

    public function update($id)
    {
        $this->authorize('edit category');
        $category = Category::findOrFail($id);

        $this->validate(
            [
                'name' => 'required|unique:categories,name,' . $id,
            ],
            [
                'name.required' => 'The name is required.',
            ]
        );

        $category->name = $this->name;

        $category->save();

        $this->dispatch('closeEditModal');
    }
    public function confirm($id)
    {
        $this->authorize('delete category');
        $category = Category::findOrFail($id);
        $this->name = $category->name;
        $this->category_id = $category->id;
    }

    public function destroy($id)
    {
         $this->authorize('delete category');
        $category = Category::findOrFail($id);
        $category->delete();

        $this->dispatch('closeDeleteModal');
    }
}
