<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Log In | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style"
        id="darkstyle">
</head>

<body class="authentication-bg pb-0" data-layout-config="{&quot;darkMode&quot;:false}">
    <div class="auth-fluid">
        @include('admin.components.toast')
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-left">
                        <a href="index.html" class="logo-dark">
                            <span><img src="assets/images/logo-dark.png" alt="" height="18"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                    <!-- form -->
                    <form method="POST" id="formLogin">
                        @csrf
                        <div class="form-group">
                            <label for="emailaddress">Email address</label>
                            <input class="form-control" name="email" type="email" placeholder="Enter your email">
                            <div class="invalid-feedback print-error-msg" style="display:none" id="email"></div>
                        </div>
                        <div class="form-group">
                            <a href="#" class="text-muted float-right"><small>Forgot your password?</small></a>
                            <label for="password">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Enter your password">
                            <input class="form-control" name="role" type="hidden" value="1" >
                            <div class="invalid-feedback print-error-msg" style="display:none" id="password"></div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit" id="btn-formLogin"><i class="mdi mdi-login"></i> Log In </button>
                        </div>
                        <!-- social-->
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Sign in with</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-printer"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('auth.redirect', 'google') }}" class="social-list-item border-info text-info"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('auth.redirect', 'github') }}" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        {{-- <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-muted ml-1"><b>Sign Up</b></a></p> --}}
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very much! . <i class="mdi mdi-format-quote-close"></i>
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
        @include('admin.layout.footer')
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @stack('js')
    <script>
        $(document).ready(function () {
            $('#btn-formLogin').click(function (e) { 
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = $('#formLogin').serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('loginHandle') }}",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == {{ config('constants.CODE_STATUS.SUCCESS') }}) {
                            console.log(11111);
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "success");
                            window.location.href = "{{ route('admin.welcome') }}";
                        }
                        else{
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "error");
                        }
                    },
                    error: function(data){
                        printErrorMsg(data.responseJSON.errors);
                    }
                });
                
            });
        });
    </script>


</body></html>