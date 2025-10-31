<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css -->
    @include('layouts.admin.css')
    <!-- css -->
</head>

<body>
    <!-- Header -->
    @include('layouts.admin.header')
    <!-- Header -->

    <!-- sidebar -->
    <!-- partial:partials/_sidebar.html -->
    @include('layouts.admin.sidebar')
    <!-- sidebar -->

    <!-- Main Content -->
    @yield('content')
    <!-- Main Content -->

    <!-- footer -->
    <!-- partial:partials/_footer.html -->
    @include('layouts.admin.footer')
    <!-- footer -->
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- js -->
    @include('layouts.admin.js')
    <!-- js -->

</body>

</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

