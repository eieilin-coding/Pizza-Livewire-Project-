<?php

namespace App\Livewire\Superadmin\Permission;

use Livewire\Component;
// use App\Models\Permission;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

  use AuthorizesRequests, WithPagination;

  protected $paginationTheme = 'bootstrap';
  public $paginate = '10';
  public $search = '';

  public $name, $permission_id;
  public function render()
  {
    $this->authorize('view permission');
    $data = array(
      'title' => 'Data Category',
      'permission' => Permission::where('name', 'like', '%' . $this->search . '%')
        ->orderBy('name', 'ASC')->paginate($this->paginate)
    );
    return view('livewire.superadmin.permission.index', $data);
  }

  public function create()
  {
    $this->authorize('create permission');
    $this->resetValidation();
    $this->reset('name');
  }

  public function store(Request $request)
  {
    $this->authorize('create permission');
    $this->validate(
      [
        'name' => 'required|unique:permissions,name'
      ],
      ['name.required' => 'The name is required.',]
    );
    $category = new Permission();
    $category->name = $this->name;

    $category->save();

    $this->dispatch('closeCreateModal');
  }

  public function edit($id)
  {
    $this->authorize('edit permission');
    $this->resetValidation();
    $permission = Permission::findOrFail($id);
    $this->name = $permission->name;
    $this->permission_id = $permission->id;
  }

  public function update($id)
  {
    $this->authorize('edit permission');
$permission = Permission::findOrFail($id);

         $this->validate([
            'name' => 'required|unique:permissions,name,'.$id ,
        ], 
        ['name.required' => 'The name is required.',     
        ]
  );

    $permission->name = $this->name;
    
    $permission->save();

     $this->dispatch('closeEditModal');
  }
  public function confirm($id){
    $this->authorize('delete permission');
        $permission = Permission::findOrFail($id);
        $this->name = $permission->name;       
        $this->permission_id = $permission->id;
    }

    public function destroy($id){
      $this->authorize('delete permission');
        $permission = Permission::findOrFail($id);
        $permission->delete();

         $this->dispatch('closeDeleteModal');
    }  
}
