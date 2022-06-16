 @extends('admin.master')

 @section('content')
     <div class="container-fluid px-4">
         <h1 class="mt-4">Dashboard</h1><br>
         <div class="row">
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-info text-white mb-4">
                     <div class="card-body">Users</div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <div class="small text-white"></div>
                         <b>Total = {{ $users }}</b>
                     </div>
                 </div>
             </div>

             <div class="col-xl-3 col-md-6">
                 <div class="card bg-warning text-white mb-4">
                     <div class="card-body">Categories</div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <div class="small text-white"></div>
                         <b>Total = {{ $categories }}</b>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-success text-white mb-4">
                     <div class="card-body">Posts</div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <div class="small text-white"></div>
                         <b>Total = {{ $posts }}</b>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card mb-4">
         </div>
     </div>
 @endsection
