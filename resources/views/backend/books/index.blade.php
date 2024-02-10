<x-admin-layout>
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Books Management</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Books Management</a></li>
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
               <h5 class="card-title mb-0">Books Management</h5>
               <a href="javascript:void(0)" class="btn btn-primary  addBooks" style="float: right"><span class="bx bx-plus">Add Books</span>&nbsp;
               </a>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle yajra-datatable" style="width:100%">
                     <thead>
                        <tr>
                           <th data-ordering="false">SR No.</th>
                           <th data-ordering="false">Title</th>
                           <th data-ordering="false">Author</th>
                           <th data-ordering="false">Description</th>
                           <th data-ordering="false">Price</th>
                           <th data-ordering="false">URL</th>
                           <th data-ordering="false">Sell Count</th>
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
   <!-- Books Modal -->
   <div class="modal fade zoomIn booksModal" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
               <h5 class="modal-title" id="exampleModalLabel"><span class="las la-user-plus"></span>&nbsp;</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="validateForm" action="" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="" class="ssbook_id">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control title">
                        <span class="text-danger Errtitle"></span>
                     </div>
                     <div class="col-md-12">
                        <label>Author</label>
                        <select name="author_ids[]" class="form-control authorsData" multiple>
                           <option value=""></option>
                        </select>
                     </div>
                     <span class="text-danger Errauthor_id"> </span>
                  </div>
                  <div class="col-md-12">
                     <label>Price</label>
                     <input type="number" name="price" class="form-control price">
                     <span class="text-danger Errprice"></span>
                  </div>
                  <div class="col-md-12">
                     <label>Sell Count</label>
                     <input type="number" name="sellCount" class="form-control sellCount">
                     <span class="text-danger ErrsellCount"></span>
                  </div>
                  <div class="col-md-12">
                     <label>Description</label>
                     <textarea name="description" class="form-control description"></textarea>
                     <span class="text-danger Errdescription"></span>
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

   <!-- Purchase books modal -->
   <div class="modal fade zoomIn purchaseBookModal" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
               <h5 class="modal-title" id="exampleModalLabel"><span class="las la-user-plus"></span>&nbsp;</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="validateForm2" action="{{ route('admin.books.purchase') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="book_id" value="" class="purchase_book_id">
               <div class="modal-body">
                  <lable>Purchase Qty</lable>
                  <input type="number" class='form-control' name='qty' required>
               </div>
               <div class="modal-footer">
                  <div class="hstack gap-2 justify-content-end">
                     <x-backend.preloader2 />
                     <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success" id="add-btn"><span class=" las la-plus-circle"></span>&nbsp;Purchase</button>
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
        ajax: "{{ route('admin.books.index') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false,searchable: false},
          {data: 'title', name: 'title'},
          {data: 'author_id', name: 'author_id'},
          {data: 'description', name: 'description'},
          {data: 'price', name: 'price'},
          {data: 'url', name: 'url'},
          {data: 'sellCount', name: 'sellCount'},
          {data: 'status', name: 'status'},
          {data: 'created_at', name: 'created_at'},
          {data: 'action', name: 'action'},        
        ],
       createdRow: function( row, data, dataIndex ) {
         $(row).attr('row-id',data.id+'-books');
         $(row).attr('row-book_id',data.id);
         $(row).attr('row-title',data.title);
         $(row).attr('row-author_id',data.author_id);
         $(row).attr('row-description',data.description);
         $(row).attr('row-price',data.price);
         $(row).attr('row-sellCount',data.sellCount);
         $(row).attr('row-slider_image',data.image);
       }
     });
   });
</script>