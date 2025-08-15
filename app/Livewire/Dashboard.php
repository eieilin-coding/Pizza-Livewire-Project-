<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;
    public $totalCategories, $totalPermissions, $totalProducts, $totalUsers;
    public function render()
    {
        $this->authorize('view dashboard'); 
        $this->totalProducts = Product::count();
        $this->totalUsers = User::count();
        $this->totalCategories = Category::count();
        $this->totalPermissions = Permission::count();
        return view('livewire.dashboard');
    }
}
