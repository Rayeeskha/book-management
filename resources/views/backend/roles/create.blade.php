<x-admin-layout>

<div class="card">
    <h5 class="card-header">Add Role & Permission</h5>
    <div class="card-body">
      <form action="{{ route('admin.roles.store')}}"  method="post" enctype="multipart/form-data" class="validateForm">     
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-lg-3 col-sm-12">
               <div class="form-group">
                  <label>Role</label>
                  <input type="text" name="role_name" class="form-control">
                  <span class="text-danger Errrole_name"></span>
               </div>
            </div>
            <div class="col-lg-9 col-sm-12">
               <div class="form-group">
                  <label>Role Description</label>
                  <input type="text" name="role_description" class="form-control">
               </div>
            </div>
         </div>
            <div class="row">
               <div class="col-12">
                  <div class="productdetails product-respon">
                     <ul>
                        @if(isset($modules[0]))
                           @foreach($modules as $modu)
                              <li>                           
                                 <h4 class="mb-1">
                                    <label>
                                    <input type="checkbox" value="{{ $modu->module_id }}" id="{{ $modu->module_id }}" name="module_id[]" />
                                    <span><b>{{ $modu->name }}&nbsp;List</b></span>
                                    </label>
                                 </h4>                              
                                 <div class="input-checkset">
                                    <ul>
                                       <li>
                                          <label class="inputcheck">Create
                                          <input type="checkbox" name="{{ $modu->module_id }}_add"   id="{{ $modu->module_id }}_add">
                                          <span class="checkmark"></span>
                                          </label>
                                       </li>                                  
                                       <li>
                                          <label class="inputcheck">Edit
                                          <input type="checkbox" name="{{ $modu->module_id }}_edit"   id="{{ $modu->module_id }}_edit">
                                          <span class="checkmark"></span>
                                          </label>
                                       </li>                                  
                                       <li>
                                          <label class="inputcheck">Change Status
                                          <input type="checkbox" name="{{ $modu->module_id }}_status"   id="{{ $modu->module_id }}_status">
                                          <span class="checkmark"></span>
                                          </label>
                                       </li>
                                       <li>
                                          <label class="inputcheck">View
                                          <input type="checkbox" name="{{ $modu->module_id }}_view"   id="{{ $modu->module_id }}_view">
                                          <span class="checkmark"></span>
                                          </label>
                                       </li> 
                                       <li>
                                          <label class="inputcheck">Delete
                                          <input type="checkbox" name="{{ $modu->module_id }}_delete"   id="{{ $modu->module_id }}_delete">
                                          <span class="checkmark"></span>
                                          </label>
                                       </li>                               
                                    </ul>
                                 </div>
                              </li>
                           @endforeach
                        @endif                        
                     </ul>
                  </div>
               </div>
            </div>
            </br> <br>
            <div class="col-lg-12">
               <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">Cancel</a>
               <button type="submit" class="btn btn-info me-2"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Permission</button>
            </div>
         </div>
      </div>
   </form>
    </div>
</div>

</x-admin-layout>