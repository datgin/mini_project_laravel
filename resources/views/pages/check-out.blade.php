@extends('layout.master')

@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Checkout</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Checkout</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec checkout page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <!-- checkout content Start -->
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">
                            <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Chi tiết hóa đơn</h3>
                                    <div class="ec-bl-block-content">
                                        <div class="ec-check-subtitle">Tùy chọn thanh toán</div>
                                        <span class="ec-bill-option">
                                            <span>
                                                <input type="radio" id="bill1" name="radio-group">
                                                <label for="bill1">I want to use an existing address</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="bill2" name="radio-group" checked>
                                                <label for="bill2">I want to use new address</label>
                                            </span>
                                        </span>
                                        <div class="ec-check-bill-form">
                                            <form action="#" method="post">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Tên*</label>
                                                    <input type="text" name="firstname" placeholder="Nhập tên"
                                                        required />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Họ*</label>
                                                    <input type="text" name="lastname" placeholder="Nhập họ" required />
                                                </span>
                                                <span class="ec-bill-wrap">
                                                    <label>Địa chỉ chi tiết</label>
                                                    <input type="text" name="address"
                                                        placeholder="Nhập địa chỉ chi tiết" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Thành phố *</label>
                                                    <span class="ec-bl-select-inner">
                                                        <select name="ec_select_city" id="ec-select-city"
                                                            class="ec-bill-select">
                                                            <option selected disabled>City</option>
                                                            <option value="1">City 1</option>
                                                            <option value="2">City 2</option>
                                                            <option value="3">City 3</option>
                                                            <option value="4">City 4</option>
                                                            <option value="5">City 5</option>
                                                        </select>
                                                    </span>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" name="postalcode"
                                                        placeholder="Nhập số điện thoại của bạn" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Huyện *</label>
                                                    <span class="ec-bl-select-inner">
                                                        <select name="ec_select_country" id="ec-select-country"
                                                            class="ec-bill-select">
                                                            <option selected disabled>Country</option>
                                                            <option value="1">Country 1</option>
                                                            <option value="2">Country 2</option>
                                                            <option value="3">Country 3</option>
                                                            <option value="4">Country 4</option>
                                                            <option value="5">Country 5</option>
                                                        </select>
                                                    </span>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Xã</label>
                                                    <span class="ec-bl-select-inner">
                                                        <select name="ec_select_state" id="ec-select-state"
                                                            class="ec-bill-select">
                                                            <option selected disabled>Region/State</option>
                                                            <option value="1">Region/State 1</option>
                                                            <option value="2">Region/State 2</option>
                                                            <option value="3">Region/State 3</option>
                                                            <option value="4">Region/State 4</option>
                                                            <option value="5">Region/State 5</option>
                                                        </select>
                                                    </span>
                                                </span>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <span class="ec-check-order-btn">
                                <a class="btn btn-primary" href="#">ĐẶT HÀNG</a>
                            </span>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Bản tóm tắt</h3>
                            </div>
                            <div class="ec-sb-block-content">

                                <div class="ec-checkout-pro">
                                    @php
                                        $i = 0;
                                        $total = 0;
                                    @endphp

                                    @foreach (Session()->get('cart') as $item)
                                        <div class="col-sm-12  @if ($i == count(Session()->get('cart')) - 1) mb-0 @else mb-6 @endif ">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image" src="{{ asset($item['image']) }}"
                                                                alt="Product" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title"><a
                                                            href="product-left-sidebar.html">{{ $item['name'] }}</a></h5>
                                                    <div class="ec-pro-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star"></i>
                                                    </div>
                                                    <span class="ec-price">
                                                        <span class="new-price">${{ $item['price'] }}
                                                            <small>x{{ $item['quantity'] }}</small></span>
                                                    </span>
                                                    <span>{{ $item['color'] }} - {{ $item['size'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                            $total += $item['price'] * $item['quantity'];
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="ec-checkout-summary mt-5">
                                    <div>
                                        <span class="text-left">Tổng phụ</span>
                                        <span
                                            class="text-right">${{ Session()->has('cart') ? number_format($total) : 0 }}</span>
                                    </div>
                                    {{-- <div>
                                        <span class="text-left">Delivery Charges</span>
                                        <span class="text-right">$80.00</span>
                                    </div> --}}
                                    <div>
                                        <span class="text-left">Phiếu giảm giá</span>
                                        <span class="text-right"><a class="ec-checkout-coupan">Áp dụng</a></span>
                                    </div>
                                    <div class="ec-checkout-coupan-content">
                                        <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                            method="post" action="#">
                                            <input class="ec-coupan" type="text" required=""
                                                placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                                            <button class="ec-coupan-btn button btn-primary" type="submit"
                                                name="subscribe" value="">Apply</button>
                                        </form>
                                    </div>
                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Tổng cộng</span>
                                        <span class="text-right ec-checkout-total">$
                                            {{ Session()->has('cart') ? number_format($total) : 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                    {{-- <div class="ec-sidebar-wrap ec-checkout-del-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Delivery Method</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-del">
                                    <div class="ec-del-desc">Please select the preferred shipping method to use on this
                                        order.</div>
                                    <form action="#">
                                        <span class="ec-del-option">
                                            <span>
                                                <span class="ec-del-opt-head">Free Shipping</span>
                                                <input type="radio" id="del1" name="radio-group" checked>
                                                <label for="del1">Rate - $0 .00</label>
                                            </span>
                                            <span>
                                                <span class="ec-del-opt-head">Flat Rate</span>
                                                <input type="radio" id="del2" name="radio-group">
                                                <label for="del2">Rate - $5.00</label>
                                            </span>
                                        </span>
                                        <span class="ec-del-commemt">
                                            <span class="ec-del-opt-head">Add Comments About Your Order</span>
                                            <textarea name="your-commemt" placeholder="Comments"></textarea>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div> --}}
                    <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">PHƯƠNG THỨC THANH TOÁN</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-pay">
                                    <div class="ec-pay-desc">Vui lòng chọn phương thức thanh toán cho đơn hành này.</div>
                                    <form action="#">
                                        <span class="ec-pay-option">
                                            <span>
                                                <input type="radio" id="pay1" name="radio-group" checked>
                                                <label for="pay1">Thanh toán khi nhận hàng</label>
                                            </span>
                                        </span>
                                        <span class="ec-pay-commemt">
                                            <span class="ec-pay-opt-head">Thêm ghi chú cho đơn hành</span>
                                            <textarea name="your-commemt" placeholder="Ghi chú"></textarea>
                                        </span>
                                        <span class="ec-pay-agree"><input type="checkbox" value=""><a
                                                href="#">Tôi đã đọc và đồng ý với <span>Điều khoản & Điều
                                                    kiện</span></a><span class="checked"></span></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                    {{-- <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Phương thức thanh toán</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-check-pay-img-inner">
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment1.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment2.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment3.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment4.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment5.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment6.png" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="assets/images/icons/payment7.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
