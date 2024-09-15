<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" id="darkstyle">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body class="authentication-bg pb-0" data-layout-config="{&quot;darkMode&quot;:false}">

    <div class="auth-fluid">
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
                    <h4 class="mt-0">Free Sign Up</h4>
                    <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute
                    </p>

                    <!-- form -->
                    <form method="POST" id="formRegister" enctype="multipart/form-data">
                        @csrf
                        @auth
                            <input type="hidden" name="role" value="0">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input class="form-control" type="text" id="fullname" disabled value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" disabled value="{{ auth()->user()->email }}">
                            </div>
                        @endauth
                        @guest
                            <input type="hidden"  name="role"  value="1">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input class="form-control" type="text" id="fullname" name="name" placeholder="Enter your name"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" name="email" required=""
                                    placeholder="Enter your email">
                            </div>
                        @endguest

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" required="" id="password"
                                placeholder="Enter your password" name="password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                <label class="custom-control-label" for="checkbox-signup">I accept <a
                                        href="javascript: void(0);" class="text-muted">Terms and Conditions</a></label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="button" id="submitngu"><i
                                    class="mdi mdi-account-circle"></i> Sign Up </button>
                        </div>
                        <!-- social-->
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Already have account? <a href="{{ route('login') }}"
                                class="text-muted ml-1"><b>Log In</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very
                    much! . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - Hyper Admin User
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    
    <script>
        $("#submitngu").click(function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            data = $('#formRegister').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('registering') }}",
                data: data,
                dataType: "json",
                success: function(data) {
                    window.location.href = "{{ route('admin.welcome') }}";
                },
                error: function(data) {
                    console.log(data.responseJSON.errors);
                }
            });
        });
    </script>


</body>

</html>
