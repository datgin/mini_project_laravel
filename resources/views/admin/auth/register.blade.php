<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Andshop - Admin Dashboard HTML Template.">

    <title>Andshop - Admin Dashboard HTML Template.</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap"
        rel="stylesheet">

    <link href="{{ asset('admin-assets/assets/css/materialdesignicons.min.css') }}" rel="stylesheet" />

    <!-- custom css -->
    <link id="style.css')}}" rel="stylesheet" href="{{ asset('admin-assets/assets/css/style.css') }}" />

    <!-- FAVICON -->
    <link href="{{ asset('admin-assets/assets/img/favicon.png') }}" rel="shortcut icon" />
</head>

<body class="sign-inup" id="body">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-10 offset-lg-1">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="login_area_left_wrapper">
                            <div class="login_logo_area">
                                <img src="{{ asset('admin-assets/assets/img/logo/logo-login.png') }}" alt="">
                                <p>Nulla laborum sit voluptate anim in. Nulla ut qui ex
                                    ipsum id aliqua amet exercitation. Anim ididunt
                                    anim anim voluptate enim.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login_area_right_wrapper">
                            <div class="login_area_right_heading">
                                <h4>Register account</h4>
                                <p>Sign up to join <a href="#!">AndShop</a></p>
                            </div>
                            <div class="login_form_wrapper">
                                <form action="" method="post" id="login_form">
                                    @csrf
                                    <div class="form-group">
                                        <label>User name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter name" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="Enter email address" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="Enter password" value="{{old('confirm_password')}}">
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="login_form_forget">
                                        <p>By registering you agree to the AndShop Terms of Service</p>
                                    </div>
                                    <div class="login_form_bottm_area">
                                        <button type="submit" class="btn btn-primary w-100">Register</button>
                                        <div class="login_middel_title">
                                            <p>Already have account</p>
                                        </div>
                                        <a href="{{ route('admin.login') }}" class="btn custom_button w-100">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('admin-assets/assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/jquery-zoom/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/slick/slick.min.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('admin-assets/assets/js/custom.js') }}"></script>

    {{-- <script>
        $(document).ready(function() {
            $('#login_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.register') }}",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            window.location.href = "{{ route('admin.login') }}";
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                })
            })
        })
    </script> --}}
</body>


</html>
