var assetBaseUrl = "http://mini_project.test/";

$(document).ready(function () {
    // Thiết lập token CSRF cho các yêu cầu AJAX
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    const USDollar = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    });
    var selectedColor = null;
    var selectedSize = null;

    var colorActive = null;
    var sizeActive = null;

    function resetActiveAttrs() {
        $(".color-box").removeClass("active");
        $(".size-box").removeClass("active");

        colorActive = false;
        sizeActive = false;

        selectedColor = null;
        selectedSize = null;
    }

    function checkNullable(selectedColor, selectedSize) {
        if (selectedColor === null || selectedSize === null) {
            $(".ec-single-cart-btn").attr("disabled", true);
        } else {
            $(".ec-single-cart-btn").removeAttr("disabled");
        }
    }

    checkNullable(selectedColor, selectedSize);

    function attachClickHandlers() {
        // Use event delegation to handle click events for dynamically added elements
        $(document).on("click", ".click-attr", function () {
            var attr_name = $(this).data("name");
            var idPro = $(".ec-single-cart-btn").data("product_id");

            if (attr_name === "color") {
                if (!$(this).hasClass("active")) {
                    $(".color-box").removeClass("active");
                    $(this).addClass("active");
                    selectedColor = $(this).data("color");
                    colorActive = true;
                    sizeActive = false;
                    callAPI(selectedColor, selectedSize, idPro, attr_name);
                }
            } else if (attr_name === "size") {
                if (!$(this).hasClass("active")) {
                    $(".size-box").removeClass("active");
                    $(this).addClass("active");
                    selectedSize = $(this).data("size");
                    sizeActive = true;
                    colorActive = false;
                    callAPI(selectedColor, selectedSize, idPro, attr_name);
                }
            }

            checkNullable(selectedColor, selectedSize);
        });
    }

    // Call function to attach event handlers
    attachClickHandlers();

    // Hàm gọi API
    function callAPI(color, size, idPro, type) {
        let data = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            idPro: idPro,
        };

        if (type === "color") {
            data.color = color;
        } else if (type === "size") {
            data.size = size;
        }

        $.ajax({
            type: "POST",
            url: "http://mini_project.test/getVariants",
            data: data,
            success: function (res) {
                // Ensure 'variant_quantity' and 'data' are defined
                if (!res.variant_quantity || !res.data) {
                    console.error("Missing data in response", res);
                    return;
                }

                var quantity = res.variant_quantity;

                if (type === "color") {
                    var sizes = res.data;
                    var _html = "";
                    for (var i = 0; i < sizes.length; i++) {
                        var _class = quantity[i] == 0 ? "no-drop" : "cursor ";
                        var _attribute = quantity[i] == 0 ? "disabled" : "";

                        var isActive = selectedSize == sizes[i] ? "active" : "";

                        _html +=
                            '<button data-name="size" data-size="' +
                            sizes[i] +
                            '" ' +
                            _attribute +
                            ' class="size-box p-2 border rounded mr-3 mb-3 click-attr ' +
                            _class +
                            isActive +
                            '">' +
                            sizes[i] +
                            "</button>";
                    }

                    $(".show-size").html(_html);
                    // Re-apply active state of color when updating DOM for size
                    if (colorActive) {
                        $(
                            '.click-color[data-color="' + selectedColor + '"]'
                        ).addClass("active");
                    }
                } else if (type === "size") {
                    var colors = res.data;
                    var images = res.variants_image;
                    var _html = "";
                    for (var i = 0; i < colors.length; i++) {
                        var _attribute = quantity[i] == 0 ? "disabled" : "";
                        var _class = quantity[i] == 0 ? "no-drop" : "cursor ";

                        const isActive =
                            selectedColor == colors[i] ? "active" : "";

                        _html +=
                            '<button data-image="' +
                            images[i] +
                            '" ' +
                            _attribute +
                            ' data-name="color" data-color="' +
                            colors[i] +
                            '" class="color-box d-flex align-items-center mr-3 border rounded p-1 click-attr ' +
                            _class +
                            isActive +
                            '">' +
                            '<img width="24.4px" height="36.6px" src="' +
                            assetBaseUrl +
                            images[i] +
                            '" alt="variation">' +
                            '<p class="mb-0 pl-2">' +
                            colors[i] +
                            "</p></button>";
                    }

                    $(".show-color").html(_html);
                    // Re-apply active state of size when updating DOM for color
                    if (sizeActive) {
                        $(
                            '.size-box[data-size="' + selectedSize + '"]'
                        ).addClass("active");
                    }
                }
            },
            error: function (error) {
                console.error("Error in API call:", error);
            },
        });
    }

    function addToCart(
        productID,
        selectedImage,
        selectedColor,
        selectedSize,
        quantity
    ) {
        $.ajax({
            url: "http://mini_project.test/add-to-cart",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                product_id: productID,
                image: selectedImage,
                quantity: quantity,
                size: selectedSize,
                color: selectedColor,
            },
            success: function (response) {
                if (response.success) {
                    $(".cart-count-lable").text(response.count);
                    sweetalertSuccess();
                    resetActiveAttrs();
                    uploadCart(response.cart, response.count);
                } else {
                    alert("Failed to add product to cart.");
                }
            },
            error: function (error) {
                console.error("Error adding product to cart", error);
            },
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
            },
        });
        Toast.fire({
            icon: "success",
            title: "<p style='font-size: 15px;'>Thêm giỏ hàng thành công</p>",
        });
    }

    $(".ec-single-cart-btn").on("click", function () {
        var $blockItem = $(this).closest(".single-pro-content");
        var selectedColor =
            $blockItem.find(".color-box.active").data("color") || null;
        var selectedSize =
            $blockItem.find(".size-box.active").data("size") || null;
        var selectedImage =
            "http://mini_project.test/" +
                $blockItem.find(".color-box.active").data("image") || null;
        const productID = $(this).data("product_id");
        var quantity = $blockItem.find(".qty-input").val();

        addToCart(
            productID,
            selectedImage,
            selectedColor,
            selectedSize,
            quantity
        );
        // console.log(productID, selectedImage, selectedColor, selectedSize, quantity);
    });

    $(document).on("click", ".ec_qtybtn", function () {
        var $qtybutton = $(this);
        var QtyoldValue = $qtybutton.parent().find("input").val();
        if ($qtybutton.text() === "+") {
            var QtynewVal = parseFloat(QtyoldValue) + 1;
        } else {
            if (QtyoldValue > 1) {
                var QtynewVal = parseFloat(QtyoldValue) - 1;
            } else {
                QtynewVal = 1;
            }
        }
        $qtybutton.parent().find("input").val(QtynewVal);
    });

    $(document).on("click", ".remove-cart-item", function () {
        const cartID = $(this).data("cart");

        $.ajax({
            url: "http://mini_project.test/remove-cart-item",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                cart_id: cartID,
            },
            success: function (response) {
                if (response.success) {
                    $(".cart-count-lable").text(response.count);
                    uploadCart(response.cart, response.count);
                } else {
                    alert("Failed to remove product from cart.");
                }
            },
            error: function (error) {
                console.error("Error removing product from cart", error);
            },
        });
    });

    function uploadCart(data, count) {
        $(".cart-count-lable").text(count);

        var _html = "";
        var _html_cart = "";
        var total = 0;

        Object.keys(data).forEach((key) => {
            var item = data[key];

            total += item.price * item.quantity;
            _html += `
                <li>
                    <a href="product-detail.html" class="sidekka_pro_img"><img src="${
                        item.image
                    }" /></a>
                    <div class="ec-pro-content">
                        <a href="product-detail.html" class="cart_pro_title">${
                            item.name
                        }</a>
                        <div>
                            <span class="cart-price"><span>${USDollar.format(
                                item.price
                            )}</span> x ${item.quantity}</span>
                            <span class="pro-variant">${item.color} - ${
                item.size
            }</span>
                        </div>
                        <a href="javascript:void(0)" class="remove-cart-item" data-cart="${key}">×</a>
                    </div>
                </li>
            `;

            _html_cart += `
                <tr>
                    <td data-label="Product" class="ec-cart-pro-name">
                        <a href="product-detail.html">
                            <img src="${
                                item.image
                            }" class="ec-cart-pro-img mr-4"/>
                            <div>
                                <p class="m-0">${item.name}</p>
                                <small>${item.color} - ${item.size}</small>
                            </div>
                        </a>
                    </td>
                    <td data-label="Price" class="ec-cart-pro-price">
                        <span class="amount">${USDollar.format(
                            item.price
                        )}</span>
                    </td>
                    <td class="ec-cart-pro-qty" style="text-align: center;">
                        <div class="cart-qty-plus-minus">
                            <button data-cart="${key}" type="button" class="ec_qty_btn">-</button>
                            <input class="cart-plus-minus" type="number" name="cartqtybutton" value="${
                                item.quantity
                            }" />
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

        $(".total-price").text(USDollar.format(total));
        $(".ec-cart-total").text(USDollar.format(total));
        $(".eccart-pro-items").html(_html);
        $(".ec-cart-items").html(_html_cart);
    }
});
