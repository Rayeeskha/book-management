<x-admin-layout>
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Author revenue tracking</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Author revenue tracking</a></li>
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
               <h5 class="card-title mb-0">Author revenue tracking</h5>
               
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle yajra-datatable" style="width:100%">
                     <thead>
                        <tr>
                           <th data-ordering="false">SR No.</th>
                           <th>Author Name</th>
                           <th>Email</th>
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

<div class="modal fade zoomIn authorModal" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
     <div class="modal-content border-0">
        <div class="modal-header p-3 bg-soft-info">
           <h5 class="modal-title" id="exampleModalLabel"><span class="las la-user-plus"></span>&nbsp;</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
        </div>
        <form class="validateForm" action="{{ route('admin.revenue-tracking.store') }}" method="post" enctype="multipart/form-data">
           @csrf
           <input type="hidden" name="author_id" value="" class="author_id">
           <div class="modal-body">
              <lable>Author Email</lable>
              <input type="text" class='form-control author_email' name='email' required>
           </div>
           <div class="modal-footer">
              <div class="hstack gap-2 justify-content-end">
                 <x-backend.preloader />
                 <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-success" id="add-btn"><span class=" las la-plus-circle"></span>&nbsp;Notify</button>
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
        ajax: "{{ route('admin.revenue-tracking.index') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false,searchable: false},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'action', name: 'action'},
        ],
       createdRow: function( row, data, dataIndex ) {
         $(row).attr('row-id',data.id+'-authors');
         $(row).attr('row-id',data.id);
         $(row).attr('row-email',data.email);
       }
     });
   });
</script>