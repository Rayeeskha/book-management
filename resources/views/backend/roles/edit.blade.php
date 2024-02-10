<x-admin-layout>

<div class="card">
   <h5 class="card-header">Edit Role & Permission</h5>
   <div class="card-body">
      <form action="{{ route('admin.roles.store')}}"  method="post" enctype="multipart/form-data" class="validateForm">
         <input type="hidden" name="id" value="{{ @$role->id }}">      
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-3 col-sm-12">
                     <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role_name" value="{{ @$role->name }}" class="form-control">
                        <span class="text-danger Errrole_name"></span>
                     </div>
                  </div>
                  <div class="col-lg-9 col-sm-12">
                     <div class="form-group">
                        <label>Role Description</label>
                        <input type="text" name="role_description" value="{{ @$role->description }}" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="productdetails product-respon">
                        <ul>
                           @if(isset($modules[0]))
                           @foreach($modules ?? [] as $modu)
                           @php 
                           $checked = ''; $add = ''; $edit = ''; $delete = ''; $view=''; $status='';
                           if(!empty($previllage)){
                              if ( ($key1 = array_search($modu->module_id, array_column($previllage, 'module_id') ) ) !== false ) {  
                                 $checked = 'checked';
                                 $add = @($previllage[$key1]['add_per']) ? 'checked' : ''; 
                                 $edit = @($previllage[$key1]['edit_per']) ? 'checked' : ''; 
                                 $view = @($previllage[$key1]['view_per']) ? 'checked' : '';
                                 $status = @($previllage[$key1]['status_per']) ? 'checked' : ''; 
                                 $delete = @($previllage[$key1]['delete_per']) ? 'checked' : ''; 
                              }
                           }
                           
                           @endphp
                           <li>
                              <h4 class="mb-1">
                                 <label>
                                 <input type="checkbox" value="{{ $modu->module_id }}" id="{{ $modu->module_id }}" name="module_id[]" {{ $checked }} />
                                 <span><b>{{ $modu->name }}&nbsp;List</b></span>
                                 </label>
                              </h4>
                              <div class="input-checkset">
                                 <ul>
                                    <li>
                                       <label class="inputcheck">Create
                                       <input type="checkbox" name="{{ $modu->module_id }}_add"   id="{{ $modu->module_id }}_add" {{ @$add }}>
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="inputcheck">Edit
                                       <input type="checkbox" name="{{ $modu->module_id }}_edit"  id="{{ $modu->module_id }}_edit" {{ @$edit }}>
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="inputcheck">Change Status
                                       <input type="checkbox" name="{{ $modu->module_id }}_status"   id="{{ $modu->module_id }}_status" {{ $status }}>
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="inputcheck">View
                                       <input type="checkbox" name="{{ $modu->module_id }}_view"  id="{{ $modu->module_id }}_view" {{ $view }}>
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="inputcheck">Delete
                                       <input type="checkbox" name="{{ $modu->module_id }}_delete"  id="{{ $modu->module_id }}_delete" {{ @$delete }}>
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
                  <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Permission</button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>

</x-admin-layout>