<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Koperasi Wanita Jasmine Sejahter</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset("/img/koperasi.png") }} >
    <!-- Custom Stylesheet -->
    <link href={{ asset("/template/css/style.css") }} rel="stylesheet">
    <link href={{asset ("/template/plugins/summernote/dist/summernote.css") }} rel="stylesheet">
    <link href={{asset ("/template/css/style.css") }} rel="stylesheet">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        
        <!--**********************************
            Nav header end
        ***********************************-->
        @include('anggota.layouts.partials.nav')
        <!--**********************************
            Header start
        ***********************************-->
        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       @include('anggota.layouts.partials.side')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
       @yield('content')
       </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        @include('anggota.layouts.partials.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src={{ asset("/template/plugins/common/common.min.js") }}></script>
    <script src={{ asset("/template/js/custom.min.js") }}></script>
    <script src={{ asset("/template/js/settings.js") }}></script>
    <script src={{ asset("/template/js/gleek.js") }}></script>
    <script src={{ asset("/template/js/styleSwitcher.js") }}></script>

</body>

</html>