@extends('layout.master')

@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Register</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Register</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Start Register -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="section-title">
                        <h2 class="ec-bg-title">Đăng ký</h2>
                        <h2 class="ec-title">Đăng ký</h2>
                    </div>
                </div>
                <div class="ec-register-wrapper">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Tên đăng nhập</label>
                                    <input type="text" name="name" placeholder="Nhập tên của bạn" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="Nhập địa chỉ email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="password" placeholder="Nhập mật khẩu" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" />
                                    @error('repassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </span>

                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                    <a href="{{ route('login') }}" class="btn btn-secondary" type="submit">Login</a>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register -->
@endsection
