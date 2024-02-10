<x-admin-layout>
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Role Management</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Role Management</a></li>
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
               <h5 class="card-title mb-0">Role Management</h5>
               <a href="{{ route('admin.roles.create') }}" class="btn btn-primary  addBooks" style="float: right"><span class="bx bx-plus">Add Role</span>&nbsp;
               </a>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle yajra-datatable" style="width:100%">
                     <thead>
                        <tr>
                           <th data-ordering="false">SR No.</th>
                           <th data-ordering="false">Name</th>
                           <th data-ordering="false">Permission</th>
                           <th data-ordering="false">Description</th>
                           <th data-ordering="false">Status</th>
                           <th data-ordering="false">Action</th>
                     </thead>
                     <tbody></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
    </div>
  
</x-admin-layout>
<script type="text/javascript">
   $(function () {
      let table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.roles.index') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false,searchable: false},
          {data: 'name', name: 'name'},
          {data: 'permissions', name: 'permissions'},
          {data: 'description', name: 'description'},
          {data: 'status', name: 'status'},
          {data: 'action', name: 'action'},        
         ],
         createdRow: function( row, data, dataIndex ) {
            $(row).attr('row-id',data.id+'-roles');
         }
      });
   });
</script>