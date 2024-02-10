<x-admin-layout>
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">User Management</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Blog table -->
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title mb-0">User Management</h5>
               <a href="javascript:void(0)" class="btn btn-primary addUser" style="float: right; margin-left:10px" ><span class="bx bx-plus">Add User</span>
               </a>
               <a href="{{ route('admin.roles.create') }}" class="btn btn-primary " style="float: right" ><span class="bx bx-plus">Add Role</span>&nbsp;
               </a>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle yajra-datatable" style="width:100%">
                     <thead>
                        <tr>
                           <th data-ordering="false">SR No.</th>
                           <th data-ordering="false">Name</th>
                           <th data-ordering="false">Email</th>
                           <th data-ordering="false">Number</th>
                           <th data-ordering="false">Role</th>
                           <th>Status</th>
                           <th>created at</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!--end col-->
   </div>
   <!-- Blog Modal -->
   <div class="modal fade zoomIn userModal" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
               <h5 class="modal-title" id="exampleModalLabel"><span class="las la-user-plus"></span>&nbsp;</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="validateForm" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="" class="user_id">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control name">
                        <span class="text-danger Errname"></span>
                     </div>
                     <div class="col-md-12">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control email">
                        <span class="text-danger Erremail"></span>
                     </div>
                     <div class="col-md-12">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control number">
                        <span class="text-danger Errnumber"></span>
                     </div>
                     <div class="col-md-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control password">
                        <span class="text-danger Errpassword"></span>
                     </div>
                     <div class="col-md-12">
                        <label>Roles</label>
                        <select name="role_id" class="form-control rolesData">
                           <option value=""></option>
                        </select>
                     </div>
                     <span class="text-danger Errrole_id"> </span>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="hstack gap-2 justify-content-end">
                     <x-backend.preloader />
                     <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success" id="add-btn"><span class=" las la-plus-circle"></span>&nbsp;Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-admin-layout>
<script type="text/javascript">
   $(function () {
     let table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.users.index') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false,searchable: false},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'number', name: 'number'},
          {data: 'role_id', name: 'role_id'},
          {data: 'status', name: 'status'},
          {data: 'created_at', name: 'created_at'},
          {data: 'action', name: 'action'},        
        ],
       createdRow: function( row, data, dataIndex ) {
         $(row).attr('row-id',data.id+'-users');
         $(row).attr('row-user_id',data.id);
         $(row).attr('row-name',data.name);
         $(row).attr('row-email',data.email);
         $(row).attr('row-number',data.number);
         $(row).attr('row-role_id',data.role_id);
       }
     });
   });
</script>