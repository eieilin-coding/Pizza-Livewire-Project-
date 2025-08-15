 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>{{ $title }}</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">{{ $title }}</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">

         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <div class="d-flex justify-content-between">
                     <div>
                         @can('create user')
                             <button wire:click="create" class="btn btn-sm bg-primary" data-toggle="modal"
                                 data-target="#createModal">
                                 <i class="fas fa-plus mr-2"></i>Create Data</button>
                         @endcan
                     </div>
                     <div class="btn-group dropleft">
                         <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-print mr-1"></i>Print
                         </button>
                         <div class="dropdown-menu ">
                             <a href="{{ route('superadmin.user.excel') }}" class="dropdown-item text-success"><i
                                     class="fas fa-file-excel mr-1"></i>Excel</a>
                             <a href="{{ route('userPdf') }}" class="dropdown-item text-danger"><i
                                     class="fas fa-file-pdf mr-1"></i>Pdf</a>
                         </div>
                     </div>

                 </div>
             </div>
             <div class="card-body">

                 <div class="mb-3 d-flex justify-content-between">
                     <div class="col-2">
                         <select wire:model.live="paginate" class="form-control">
                             <option value="10">10</option>
                             <option value="20">20</option>
                             <option value="25">25</option>
                             <option value="30">30</option>
                         </select>
                     </div>
                     <div class="col-6">
                         <input wire:model.live='search' type="text" class="form-control" placeholder="Search..">
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-hover">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th><i class="fas fa-cog"></i></th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($user as $index => $item)
                                 <tr>
                                     <td>{{ ($user->currentPage() - 1) * $user->perPage() + $loop->iteration }}</td>
                                     <td>{{ $item->name }}</td>
                                     <td>{{ $item->email }}</td>
                                     <td> {{ $item->roles->pluck('name')->implode(', ') }}</td>

                                     <td>
                                         @can('edit user')
                                             <button wire:click="edit({{ $item->id }})" class="btn btn-sm bg-warning"
                                                 data-toggle="modal" data-target="#editModal">
                                                 <i class="fas fa-edit"></i></button>
                                         @endcan
                                         @can('delete user')
                                             <button wire:click="confirm({{ $item->id }})" class="btn btn-sm bg-danger"
                                                 data-toggle="modal" data-target="#deleteModal">
                                                 <i class="fas fa-trash"></i></button>
                                         @endcan
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                     <div>{{ $user->links() }}</div>
                 </div>
             </div>

         </div>
         <!-- /.card -->

     </section>
     @include('livewire.superadmin.user.create')

     @script
         <script>
             $wire.on('closeCreateModal', () => {
                 $('#createModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "User Create Successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript

     <!-- Edit Modal --->
     @include('livewire.superadmin.user.edit')

     @script
         <script>
             $wire.on('closeEditModal', () => {
                 $('#editModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "User edited successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript

     <!--- Delete Modal --->
     @include('livewire.superadmin.user.delete')

     @script
         <script>
             $wire.on('closeDeleteModal', () => {
                 $('#deleteModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "User deleted successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript
     <!-- /.content -->
 </div>
