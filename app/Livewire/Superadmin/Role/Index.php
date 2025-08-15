<?php

namespace App\Livewire\Superadmin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';

    public $name, $role_id;
    public $permissions = [];
    public $allPermissions = [];

     protected $rules = [
        'name' => 'required|min:3|unique:roles,name',
        'permissions' => 'array'
    ];

    public function mount()
    {
        // Load all permissions for create/edit modals
        $this->allPermissions = Permission::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        $this->authorize('view role');
        $roles = Role::with('permissions')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate($this->paginate);

        return view('livewire.superadmin.role.index', [
            'roles' => $roles, 'title' => "Roles"
        ]);
    }

    public function create()
    {
        $this->authorize('create role');
        $this->resetValidation();
        $this->reset(['name', 'permissions', 'role_id']);
    }

    public function store()
    {
        $this->authorize('create role');
        $this->validate();

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permissions);

        $this->dispatch('closeCreateModal');
    }

   public function edit($id)
    {
        $this->authorize('edit role');
        $role = Role::with('permissions')->findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('name')->toArray();
    }

    public function update()
    {
        $this->authorize('edit role');
        $this->validate([
            'name' => 'required|min:3|unique:roles,name,' . $this->role_id
        ]);

        $role = Role::findOrFail($this->role_id);
        $role->name = $this->name;
        $role->save();
        $role->syncPermissions($this->permissions);

        $this->dispatch('closeEditModal');
    }

    public function confirm($id)
    {
        $this->authorize('delete role');        
        $role = Role::findOrFail($id);
        $this->name = $role->name;
        $this->role_id = $role->id;
        $this->permissions = $role->permissions->pluck('name')->toArray();
        
    }

    public function destroy()
    {
        $this->authorize('delete role'); 
        Role::findOrFail($this->role_id)->delete();
        $this->dispatch('closeDeleteModal');
    }
}
