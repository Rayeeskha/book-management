<x-backend.css />
<div class="auth-page-content" style="margin-bottom: 2%; margin-top: 10%">
   <div class="container" >
        <div class="row justify-content-center">
         <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
               <div class="card-body p-4">
                  <div class="text-center mt-2">
                    <a href="/" class="d-inline-block auth-logo">
                  <img src="{{ asset('frontend/assets/logo/logo.jpg') }}" alt="" height="50">
                  </a>
                     <h5 class="text-primary">Welcome Back !</h5>
                  </div>
                  <div class="p-2 mt-4">
                     <form method="POST" action="{{ route('login') }}" class="validateForm">
                        <div class="mb-3">
                           <label for="username" class="form-label">Email</label>
                           <input type="text" class="form-control" name="email" :value="old('email')"  autofocus autocomplete="username">

                           <span class="text-danger Erremail"></span>
                        </div>
                        <div class="mb-3">
                           <label class="form-label" for="password-input">Password</label>
                           <div class="position-relative auth-pass-inputgroup mb-3">
                              <input type="password" class="form-control pe-5 password-input" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="current-password">  
                             <span class="text-danger Errpassword"></span>          
                           </div>
                        </div>
                        <div class="mt-4">
                            <center><x-backend.preloader /></center>
                           <button class="btn btn-success w-100" type="submit">Sign In</button>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- end card body -->
            </div>
         </div>
      </div>
      <!-- end row -->
   </div>
   <!-- end container -->
</div>
<x-backend.js />