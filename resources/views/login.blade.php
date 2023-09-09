<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Wanita Jasmine Sejahtera</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/koperasi.png') }}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{ asset('/template/css/style.css') }}" rel="stylesheet">
    
    <style>
        .logo-wrapper {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 60px; /* Adjust as needed */
        }

        .logo-image {
            max-width: 200px; /* Adjust the maximum width as needed */
            height: auto;
        }

        .logo-text {
            font-size: 18px;
            margin-top: 10px;
            color: #333; /* Adjust text color as needed */
        }
    </style>
</head>

<body class="h-100">
    
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

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="logo-wrapper">
                            <img src="{{ asset('/img/koperasi.png') }}" alt="Logo" class="logo-image">
                            <p class="logo-text">Koperasi Wanita Jasmine Sejahtera</p>
                        </div>
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Login</h4></a>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="mt-5 mb-5 login-input" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('/template/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('/template/js/custom.min.js') }}"></script>
    <script src="{{ asset('/template/js/settings.js') }}"></script>
    <script src="{{ asset('/template/js/gleek.js') }}"></script>
    <script src="{{ asset('/template/js/styleSwitcher.js') }}"></script>
</body>
</html>
