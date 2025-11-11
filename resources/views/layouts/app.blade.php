<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css -->
    @include('layouts.css')
    <!-- css -->
</head>

<body>
    <!-- Header -->
    @include('layouts.header')
    <!-- Header -->

    <!-- sidebar -->
    <!-- partial:partials/_sidebar.html -->
    @include('layouts.sidebar')
    <!-- sidebar -->

    <!-- Main Content -->
    @yield('content')
    <!-- Main Content -->

    <!-- footer -->
    <!-- partial:partials/_footer.html -->
    @include('layouts.footer')
    <!-- footer -->
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- js -->
    @include('layouts.js')
    <!-- js -->

</body>


</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bootstrap Icons -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>
