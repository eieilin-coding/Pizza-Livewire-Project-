<?php

namespace App\Livewire\Superadmin\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
   
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';
    public $roles = [];
    public $allRoles = [];

    public $name, $email, $role, $password, $password_confirmation, $user_id;


     public function mount()
    {
        // Load all permissions for create/edit modals
        $this->allRoles = Role::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        $this->authorize('view user'); 
        $data = array( 
            'title' => 'Data User',
            'user' => User::where('name','like','%'. $this->search . '%' )
                                ->orWhere('email','like','%'. $this->search . '%' )
                                ->orWhere('role','like','%'. $this->search . '%' )
                                ->latest()->paginate($this->paginate));
        return view('livewire.superadmin.user.index', $data);
    }

    public function create() {
    $this->authorize('create user');
      $this->resetValidation();
      $this->reset( 'name','email', 'roles', 'password', 'password_confirmation');
    }

    public function store() {
        $this->authorize('create user');
    $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'roles' => 'required',
        'password' => 'required|min:8|confirmed',
    ], 
    [
        'name.required' => 'The name is required.',
        'email.email' => 'The email is invalid.',
        'roles.required' => 'The role is required.',
        'password.min' => 'Mininal 8 characters required.',        
        'password.confirmed' => 'The passwords do not match.',
        'password_confirmation.required' => 'The confirm password is required.'
    ]);

    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => bcrypt($this->password),
    ]);

    // Assign role via Spatie
    $user->assignRole($this->roles);

    $this->dispatch('closeCreateModal');
}

    public function edit($id){
        $this->authorize('edit user');
        // $this->resetValidation();
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->pluck('name')->toArray();
        $this->password = '';
        $this->password_confirmation = '';
        $this->user_id = $user->id;        
    }

    public function update($id){
        $this->authorize('edit user');
    $user = User::findOrFail($id);

    $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'roles' => 'required',
        'password' => 'nullable|min:8|confirmed',
    ], 
    [
        'name.required' => 'The name is required.',
        'email.email' => 'The email is invalid.',
        'email.unique' => 'The email is already taken.',
        'roles.required' => 'The role is required.',
        'password.min' => 'Mininal 8 characters required.',        
    ]);

    $user->name = $this->name;
    $user->email = $this->email;

    if(filled($this->password)) {
        $user->password = Hash::make($this->password);
    }
    
    $user->save();

    // Sync role (removes old roles and assigns the new one)
    $user->syncRoles($this->roles);

    $this->dispatch('closeEditModal');
}
    public function confirm($id){
        $this->authorize('delete user');
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->pluck('name')->toArray();
        $this->user_id = $user->id;
    }

    public function destroy($id){
        $this->authorize('delete user');
        $user = User::findOrFail($id);
        $user->delete();

         $this->dispatch('closeDeleteModal');
    }
}
