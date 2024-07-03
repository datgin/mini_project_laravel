$(document).ready(function() {
   mode: 'no-cors',
    // Thiết lập token CSRF cho các yêu cầu AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const USDollar = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    // Xử lý sự kiện click cho các biến thể (color và size)
    $(' .ec-pro-color ul li, .ec-pro-size ul li').on('click', function() {
        var $blockItem = $(this).closest('.ec-product-content');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        checkAvailability($blockItem);
    });

    function checkAvailability($blockItem) {
        var selectedColor = $blockItem.find('.ec-pro-color li.active').data('color') || null;
        var selectedSize = $blockItem.find('.ec-pro-size li.active').data('size') || null;
        var productID = $blockItem.find('.add-to-cart').data('id');

        // Nếu sản phẩm có cả hai thuộc tính, kiểm tra xem cả hai đều được chọn
        if ($blockItem.find('.ec-pro-color li').length && $blockItem.find('.ec-pro-size li').length) {
            if (!selectedColor || !selectedSize) {
                return; // Không làm gì nếu chưa chọn đủ thuộc tính
            }
        }

        // Gửi yêu cầu AJAX kiểm tra khả dụng
        $.ajax({
           mode: 'no-cors',
            url: 'http://mini_project.test/check-availability',
            type: 'GET',
            data: {
                product_id: productID,
                size: selectedSize,
                color: selectedColor
            },
            success: function(response) {
                if (response.available) {
                    $blockItem.find('.add-to-cart').removeClass('disabled').removeAttr('disabled');
                } else {
                    $blockItem.find('.add-to-cart').addClass('disabled').attr('disabled', 'disabled');
                    sweetalertError();
                }
            },
            error: function(error) {
                console.error('Error checking availability', error);
            }
        });
    }

    // Xử lý sự kiện click nút "Add To Cart"
    $('.add-to-cart').on('click', function() {
        var $blockItem = $(this).closest('.ec-product-content');
        var selectedColor = $blockItem.find('.ec-pro-color li.active').data('color') || null;
        var selectedSize = $blockItem.find('.ec-pro-size li.active').data('size') || null;
        var selectedImage = $blockItem.find('.ec-pro-color li.active').data('image') || null;
        var productID = $(this).data('id');
        var quantity = 1;

        // Nếu sản phẩm có cả hai thuộc tính, kiểm tra xem cả hai đều được chọn
        if ($blockItem.find('.ec-pro-color li').length && $blockItem.find('.ec-pro-size li').length) {
            if (!selectedColor || !selectedSize) {
                alert('Please select color and size.');
                return;
            }
        }

        addToCart(productID, selectedImage, selectedColor, selectedSize, quantity);
    });

    function addToCart(productID, selectedImage, selectedColor, selectedSize, quantity) {
        $.ajax({
           mode: 'no-cors',
            url: 'http://mini_project.test/add-to-cart',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productID,
                image: selectedImage,
                quantity: quantity,
                size: selectedSize,
                color: selectedColor
            },
            success: function(response) {
                if (response.success) {
                    $('.cart-count-lable').text(response.count);
                    sweetalertSuccess();
                    uploadCart(response.cart, response.count);
                } else {
                    alert('Failed to add product to cart.');
                }
            },
            error: function(error) {
                console.error('Error adding product to cart', error);
            }
        });
    }

    function sweetalertSuccess() {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "<p style='font-size: 15px;'>Thêm giỏ hàng thành công</p>"
        });
    }

    function sweetalertError() {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Sản phẩm này đã hết hàng!",
            showConfirmButton: false,
            timer: 1500
        });
    }

    $(document).on('click', '.remove-cart-item', function() {
        const cartID = $(this).data('cart');

        $.ajax({
           mode: 'no-cors',
            url: 'http://mini_project.test/remove-cart-item',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                cart_id: cartID
            },
            success: function(response) {
                if (response.success) {
                    $('.cart-count-lable').text(response.count);
                    uploadCart(response.cart, response.count);
                } else {
                    alert('Failed to remove product from cart.');
                }
            },
            error: function(error) {
                console.error('Error removing product from cart', error);
            }
        });
    });

    function uploadCart(data, count) {
        $('.cart-count-lable').text(count);

        var _html = '';
        var _html_cart = '';
        var total = 0;

        Object.keys(data).forEach(key => {
            var item = data[key];

            total += item.price * item.quantity;
            _html += `
                <li>
                    <a href="product-detail.html" class="sidekka_pro_img"><img src="http://mini_project.test/${item.image}" /></a>
                    <div class="ec-pro-content">
                        <a href="product-detail.html" class="cart_pro_title">${item.name}</a>
                        <div>
                            <span class="cart-price"><span>${USDollar.format(item.price)}</span> <small>x ${item.quantity}</small></span>
                            <span class="pro-variant">${item.color} - ${item.size}</span>
                        </div>
                        <a href="javascript:void(0)" class="remove-cart-item" data-cart="${key}">×</a>
                    </div>
                </li>
            `;

            _html_cart += `
                <tr>
                    <td data-label="Product" class="ec-cart-pro-name">
                        <a href="product-detail.html">
                            <img src="http://mini_project.test/${item.image}" class="ec-cart-pro-img mr-4"/>
                            <div>
                                <p class="m-0">${item.name}</p>
                                <small>${item.color} - ${item.size}</small>
                            </div>
                        </a>
                    </td>
                    <td data-label="Price" class="ec-cart-pro-price">
                        <span class="amount">${USDollar.format(item.price)}</span>
                    </td>
                    <td class="ec-cart-pro-qty" style="text-align: center;">
                        <div class="cart-qty-plus-minus">
                            <button data-cart="${key}" type="button" class="ec_qty_btn">-</button>
                            <input class="cart-plus-minus" type="number" name="cartqtybutton" value="${item.quantity}" />
                            <button data-cart="${key}" type="button" class="ec_qty_btn">+</button>
                        </div>
                    </td>
                    <td data-label="Total" class="ec-cart-pro-subtotal">
                        ${USDollar.format(item.price * item.quantity)}
                    </td>
                    <td data-label="Remove" class="ec-cart-pro-remove">
                        <button type="button" data-cart="${key}" class="remove-cart-item">
                            <i class="ecicon eci-trash-o"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        if (data.length <= 0) {
            _html = '<p class="text-center">No items in cart</p>';
        }

        $('.total-price').text(USDollar.format(total));
        $('.ec-cart-total').text(USDollar.format(total));
        $('.eccart-pro-items').html(_html);
        $('.ec-cart-items').html(_html_cart);

        // Reattach the event listeners for the quantity buttons
        UpOrDown();
    }

    function UpOrDown() {
        // Xử lý sự kiện click cho các nút + và -
        $(".cart-qty-plus-minus .ec_qty_btn").on("click", function() {
            var $cartqtybutton = $(this);
            var cartID = $cartqtybutton.data("cart");
            var CartQtyoldValue = parseFloat($cartqtybutton.parent().parent().find("input").val());
            var CartQtynewVal;

            if ($cartqtybutton.text() === "+") {
                CartQtynewVal = CartQtyoldValue + 1;
                if (CartQtynewVal > 20) {
                    CartQtynewVal = 20;
                }
            } else {
                if (CartQtyoldValue > 1) {
                    CartQtynewVal = CartQtyoldValue - 1;
                } else {
                    CartQtynewVal = 1;
                }
            }
            $cartqtybutton.parent().parent().find("input").val(CartQtynewVal);

            quantityUpdate(cartID, CartQtynewVal);
        });

        // Xử lý sự kiện focusout cho thẻ input
        $(".cart-qty-plus-minus .cart-plus-minus").on("focusout", function() {
            var $input = $(this);
            var cartID = $input.siblings(".ec_qty_btn").data("cart");
            var CartQtynewVal = parseFloat($input.val());

            // Kiểm tra giá trị hợp lệ
            if (isNaN(CartQtynewVal) || CartQtynewVal < 1) {
                CartQtynewVal = 1;
            } else if (CartQtynewVal > 20) {
                CartQtynewVal = 20;
            }

            $input.val(CartQtynewVal);
            quantityUpdate(cartID, CartQtynewVal);
        });
    }
    UpOrDown();

    function quantityUpdate(id, quantity) {
        $.ajax({
           mode: 'no-cors',
            type: "POST",
            url: 'http://mini_project.test/update-cart',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                cart_id: id,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    uploadCart(response.cart, response.count);
                } else {
                    alert('Failed to update quantity.');
                }
            },
            error: function(error) {
                console.error('Error updating quantity', error);
            }
        });
    }
});
