<x-admin-layout>
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Purchase history</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase history</a></li>
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
               <h5 class="card-title mb-0">Purchase history</h5>
               
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle yajra-datatable" style="width:100%">
                     <thead>
                        <tr>
                           <th data-ordering="false">SR No.</th>
                           <th>Purchase Id</th>
                           <th>Book</th>
                           <th>User Name</th>
                           <th>Price</th>
                           <th>Quantity</th>
                           <th>Total Amount</th>
                           <th>Purchase Date</th>
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
</x-admin-layout>

<script type="text/javascript">
   $(function () {
     let table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.purchase-history.index') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false,searchable: false},
          {data: 'purchase_id', name: 'purchase_id'},
          {data: 'book_id', name: 'book_id'},
          {data: 'user_id', name: 'user_id'},
          {data: 'price', name: 'price'},
          {data: 'quantity', name: 'quantity'},
          {data: 'total', name: 'total'},
          {data: 'created_at', name: 'created_at'},
        ],
       createdRow: function( row, data, dataIndex ) {
         $(row).attr('row-id',data.id+'-purchase_books');
       }
     });
   });
</script>