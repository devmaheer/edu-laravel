<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.partials.frontend-head')
</head>
<body >
    <!--begin::Root-->
	    <!-- Spinner Start -->
		<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
			<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<!-- Spinner End -->
	
	
		<!-- Navbar Start -->
		@include('layouts.partials.frontend-navbar')
		<!-- Navbar End -->
	
		@yield('content')
    <!--end::Root-->
    
    @include('layouts.partials.frontend-footer')
    @include('layouts.partials.frontend-script')
    @yield('script')
	
</body>
</html>