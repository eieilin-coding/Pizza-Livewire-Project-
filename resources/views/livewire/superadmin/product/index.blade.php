 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>@yield('title')</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">@yield('title')</li>
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
                         @can('create product')
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
                             <a href="#" class="dropdown-item text-success"><i
                                     class="fas fa-file-excel mr-1"></i>Excel</a>
                             <a href="#" class="dropdown-item text-danger"><i
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
                                 <th width="10px">No</th>
                                 <th width="30px">Name</th>
                                 <th width="30px">Category</th>
                                 <th>Image</th>
                                 <th width="10px">Price</th>

                                 <th width="20px"><i class="fas fa-cog"></i></th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($products as $index => $item)
                                 <tr>
                                     <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                     </td>
                                     <td>{{ $item->name }}</td>
                                     <td>{{ $item->category ? $item->category->name : '-' }}</td>
                                     <td style="width:100px">
                                         @if ($item->image)
                                             <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid"
                                                 style="max-height:70px" alt="{{ $item->name }}">
                                         @else
                                             <span class="text-muted small">No image</span>
                                         @endif
                                     </td>
                                     <td>${{ $item->price }}</td>

                                     <td>
                                         @can('edit product')
                                             <button wire:click="edit({{ $item->id }})" class="btn btn-sm bg-warning"
                                                 data-toggle="modal" data-target="#editModal">
                                                 <i class="fas fa-edit"></i></button>
                                         @endcan
                                         @can('delete product')
                                             <button wire:click="confirm({{ $item->id }})" class="btn btn-sm bg-danger"
                                                 data-toggle="modal" data-target="#deleteModal">
                                                 <i class="fas fa-trash"></i></button>
                                         @endcan
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                     <div>{{ $products->links() }}</div>
                 </div>
             </div>

         </div>
         <!-- /.card -->

     </section>
     @include('livewire.superadmin.product.create')

     @script
         <script>
             $wire.on('closeCreateModal', () => {
                 $('#createModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "Product Create Successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript

     <!-- Edit Modal --->
     @include('livewire.superadmin.product.edit')

     @script
         <script>
             $wire.on('closeEditModal', () => {
                 $('#editModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "Product edited successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript

     <!--- Delete Modal --->
     @include('livewire.superadmin.product.delete')

     @script
         <script>
             $wire.on('closeDeleteModal', () => {
                 $('#deleteModal').modal('hide');
                 Swal.fire({
                     title: "Success!",
                     text: "Product deleted successfully!",
                     icon: "success"
                 });
             });
         </script>
     @endscript
     <!-- /.content -->
 </div>
