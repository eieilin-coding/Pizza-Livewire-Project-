 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Admin Dashboard</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">Admin Dashboard</li>
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
                         <button wire:click="create" class="btn btn-sm bg-primary" data-toggle="modal"
                             data-target="#createModal">
                             <i class="fas fa-plus mr-2"></i>Create Data</button>
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
                 <p>Dashboard Overview</p>
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-lg-3 col-6">
                             <div class="small-box text-bg-primary">
                                 <div class="inner">
                                     <h3>{{ $totalProducts }}</h3>
                                     <p>Total Products</p>
                                 </div>
                             </div>
                         </div>

                         <div class="col-lg-3 col-6">

                             <div class="small-box text-bg-success">
                                 <div class="inner">
                                     <h3>{{ $totalPermissions }}</sup></h3>
                                     <p>Total Permissions</p>
                                 </div>
                             </div>
                         </div>

                         <div class="col-lg-3 col-6">

                             <div class="small-box text-bg-secondary">
                                 <div class="inner">
                                     <h3>{{ $totalUsers }}</sup></h3>
                                     <p>Total Users</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-3 col-6">
                             <div class="small-box text-bg-danger">
                                 <div class="inner">
                                     <h3>{{ $totalCategories }}</h3>
                                     <p>Total Category</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- /.row -->
                 </div>
             </div>

         </div>
         <!-- /.card -->

     </section>
     <!-- /.content -->
 </div>
