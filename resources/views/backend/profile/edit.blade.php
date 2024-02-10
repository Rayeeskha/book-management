<x-admin-layout>
 <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Profile</h4>
            <h6>User Profile</h6>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="profile-set">
               <div class="profile-head"></div>
               <div class="profile-top">
                  <div class="profile-content">
                     <div class="profile-contentimg">
                        <img src="{{ asset(session()->get('PROFILE_IMAGE') ? session()->get('PROFILE_IMAGE') : Auth::user()->profile) }}" alt="img" id="blah" style="width: 50p; height: 50px; border-radius: 50%">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="rounded shadow mt-4">
                     <div class="p-4 border-bottom">
                        <h6 class="mb-0">Personal Information :</h6>
                     </div>
                     <div class="p-4">
                        
                        <!--end row-->
                        <form  action="{{ route('admin.profile.update') }}"  
                           enctype="multipart/form-data" method="post" class="validateForm">  
                           @method('patch')                         
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input name="name" id="first_name" type="text" class="form-control" placeholder="First Name :" value="{{ Auth::user()->name }}">
                                 </div>

                                 <span class="text-danger Errname"></span>
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label class="form-label">Your Email</label>
                                    <input name="email"  type="email" class="form-control" placeholder="Your email :" value="{{ Auth::user()->email }}" readonly>
                                    <span class="text-danger Erremail"></span>
                                 </div>
                              </div>
                              <!--end col-->
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label class="form-label">Phone no.</label>
                                    <input name="number" type="text" class="form-control" placeholder="Phone no. :" value="{{ Auth::user()->number }}">
                                    <span class="text-danger Errnumber"></span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label class="form-label">profile</label>
                                    <input name="profile" type="file" class="form-control image" >
                                    <span class="text-danger Errprofile"></span>
                                 </div>
                                 <div class="preview_image_div" style="display: none;">
                                    <img src="" class="preview_image image_responsive" style="width: 50px;height: 50px; border-radius: 50%;">
                                 </div>
                                 <div class="image_show"></div>
                              </div>
                           </div>
                           <!--end row-->
                           <div class="row">
                              <div class="col-sm-12">

                                 <x-backend.preloader />

                                 <button type="submit" class="btn btn-primary " style="float: right;"><i class="fa fa-spinner fa-spin" style="display: none;"></i>&nbsp;Update</button>
                              </div>
                              <!--end col-->
                           </div>
                           <!--end row-->
                        </form>
                        <!--end form-->
                     </div>
                  </div>
               </div>
               <!--end col-->
               <div class="col-md-6">
                  <div class="rounded shadow mt-4">
                     <div class="p-4 border-bottom">
                        <h6 class="mb-0">Account Settings :</h6>
                     </div>
                     <div class="p-4">
                        <form method="post" action="{{ route('admin.password.update') }}" class="validateForm2" >
                           @csrf
                           @method('put')
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label>Current Password</label>
                                    <div class="pass-group">
                                       <input type="password" class="form-control" name="current_password" autocomplete="current-password">
                                       <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <span class="text-danger Errcurrent_password"></span>
                                 </div>
                              </div>
                              <!--end col-->
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                       <input type="password" class="form-control"  name="password" autocomplete="new-password" >
                                       <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <span class="text-danger Errpassword"></span>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="pass-group">
                                       <input type="password" class=" form-control"  name="password_confirmation" autocomplete="new-password" >
                                       <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <span class="text-danger Errpassword_confirmation"></span>
                                 </div>
                              </div>
                              <!--end col-->
                              <div class="col-lg-12 mt-2 mb-0">
                                  <x-backend.preloader2 />
                                 <button type="submit" class="btn btn-primary " style="float: right;"><i class="fa fa-spinner fa-spin spinner" style="display: none;"></i>&nbsp;Update</button>
                              </div>
                              <!--end col-->
                           </div>
                           <!--end row-->
                        </form>
                     </div>
                  </div>
               </div>
               <!--end col-->
            </div>
         </div>
      </div>
   </div>
</x-admin-layout>	