<x-backend.css />
<x-backend.topbar />
<x-backend.sidebar />
<div class="main-content">
    <div class="page-content">
    	{{ $slot }}
    </div>
</div>
<x-backend.footer />
<x-backend.js />