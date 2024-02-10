@php 
   $role_id = Auth::user()->role_id;
   $allPermission = false;
   if(!empty($role_id) && $role_id == '1'){
      $allPermission = true;
   }
   $group = CustomHelper::getUserRolePermission();
@endphp

<div class="app-menu navbar-menu">
<!-- LOGO -->
<div class="navbar-brand-box">
   <!-- Dark Logo-->
   <a href="#!" class="logo logo-dark">
   <span class="logo-sm">
   <img src="{{ asset('frontend/assets/logo/logo.jpg') }}" alt="" height="22">
   </span>
   <span class="logo-lg">
   <img src="{{ asset('frontend/assets/logo/logo.jpg') }}" alt="" height="17">
   </span>
   </a>
   <!-- Light Logo-->
   <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
   <span class="logo-sm">
   <img src="{{ asset('frontend/assets/logo/logo.jpg') }}" alt="" height="22">
   </span>
   <span class="logo-lg">
   <img src="{{ asset('frontend/assets/logo/logo.jpg') }}" alt="" height="60px" width="60px">
   </span>
   </a>
   <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
   <i class="ri-record-circle-line"></i>
   </button>
</div>
<div id="scrollbar">
   <div class="container-fluid">
      <div id="two-column-menu"></div>
      <ul class="navbar-nav" id="navbar-nav">
         
         <li class="nav-item">
            <a class="nav-link menu-link " href="{{ route('admin.dashboard') }}">
               <i class="ri-honour-line"></i> <span data-key="t-widgets">Dashboards</span>
            </a>
        </li>

         @if($allPermission || ((array_search('RolePermission', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="{{ route('admin.roles.index') }}">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">Role Management</span>
               </a>
            </li>
         @endif

         @if($allPermission || ((array_search('UserManagement', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="{{ route('admin.users.index') }}">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">User Management</span>
               </a>
            </li>
         @endif

         @if($allPermission || ((array_search('BookManagement', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="{{ route('admin.books.index') }}">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">Book Management</span>
               </a>
            </li>
         @endif

         @if($allPermission || ((array_search('PurchaseHistory', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="{{ route('admin.purchase-history.index') }}">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">Purchase History</span>
               </a>
            </li>
         @endif

         @if($allPermission || ((array_search('RevenueTracking', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="{{ route('admin.revenue-tracking.index') }}">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">Revenue Tracking</span>
               </a>
            </li>
         @endif

         {{-- @if($allPermission || ((array_search('EmailNotification', array_column($group, 'module_id'))) !== false ))
            <li class="nav-item">
               <a class="nav-link menu-link " href="#!">
                  <i class="ri-layout-3-line"></i> <span data-key="t-widgets">Email Notification </span>
               </a>
            </li>
         @endif --}}
      </ul>
   </div>
   <!-- Sidebar -->
</div>
<div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>