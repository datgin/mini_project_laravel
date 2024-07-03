@extends('admin.layout.master')

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <form id="product_form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                    <div>
                        <h1>Add Product</h1>
                        <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                            <span><i class="mdi mdi-chevron-right"></i></span>Product
                        </p>
                    </div>
                    <div>
                        <a href="product-list.html" class="btn btn-primary"> View All
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Add Product</h2>
                            </div>

                            <div class="card-body">
                                <div class="row ec-vendor-uploads">
                                    <div class="col-lg-8">
                                        <div class="ec-vendor-upload-detail">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail4" class="form-label">Product name</label>
                                                    <input onkeyup="ChangeToSlug()" name="name" type="text"
                                                        class="form-control slug-title" placeholder="Casual men shirt"
                                                        id="slug" value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6  mb-3">
                                                    <label class="form-label">Categories</label>
                                                    <select name="category_id" id="Categories" class="form-select">
                                                        @if (count($categories) > 0)
                                                        <option value="" disabled selected>--- Chọn danh mục ---</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }} |
                                                                    {{ $item->slug }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail5" class="form-label">Slug</label>
                                                    <input name="slug" type="text" class="form-control slug-title"
                                                        placeholder="/slug" id="convert_slug" value="{{ old('slug') }}">
                                                    @error('slug')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail8" class="form-label">Product
                                                        quantity</label>
                                                    <input name="quantity" type="text" class="form-control"
                                                        placeholder="Product quantity" id="inputEmail8"
                                                        value="{{ old('quantity') }}">
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail9" class="form-label">Product
                                                        price</label>
                                                    <input name="price" type="text" class="form-control "
                                                        placeholder="Product price" id="inputEmail9"
                                                        value="{{ old('price') }}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail11" class="form-label">Discount (%)</label>
                                                    <input name="discount" type="text" class="form-control "
                                                        placeholder="Product discount" id="inputEmail11"
                                                        value="{{ old('discount') }}">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="6" id="description"> {{ old('description') }}</textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-6 ">
                                                    <label class=" col-form-label">Status</label>
                                                    <div class="form-check form-switch">
                                                        <input name="status" class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked" checked>
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked">Active</label>
                                                    </div>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="product_add_cancel_button">
                                                        <button type="submit" class="btn btn-border">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Add
                                                            product</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="ec-vendor-img-upload">
                                            <div class="ec-vendor-main-img">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' name="main_image" id="imageUpload"
                                                            class="ec-image-upload" accept=".png, .jpg, .jpeg" />
                                                        <label for="imageUpload"><img
                                                                src="{{ asset('admin-assets/assets/img/icons/edit.svg') }}"
                                                                class="svg_img header_svg" alt="edit" /></label>
                                                    </div>
                                                    <div class="avatar-preview ec-preview">
                                                        <div class="imagePreview ec-div-preview">
                                                            <img class="ec-image-preview"
                                                                src="{{ asset('admin-assets/assets/img/products/details-big.png') }}"
                                                                alt="edit" />
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <span class="text-danger text-center">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="thumb-upload-set colo-md-12">
                                                    <div class="thumb-upload">
                                                        <div class="thumb-edit">
                                                            <input name="images[]" type="file" id="thumbUpload01"
                                                                class="ec-image-upload" accept=".png, .jpg, .jpeg">
                                                            <label for="imageUpload"><img
                                                                    src="{{ asset('admin-assets/assets/img/icons/edit.svg') }}"
                                                                    class="svg_img header_svg" alt="edit"></label>
                                                        </div>
                                                        <div class="thumb-preview ec-preview">
                                                            <div class="image-thumb-preview">
                                                                <img class="image-thumb-preview ec-image-preview"
                                                                    src="{{ asset('admin-assets/assets/img/products/details-sm-2.png') }}"
                                                                    alt="edit">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        id="add_image">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card card-default mt-3">
                            <div class="card-header card-header-border-bottom p-3 rounded-0">
                                <label class="mr-2">Tùy biến sản phẩm-- </label>
                                <div class="col-3">
                                    <select class="form-select" id="customization_pro">
                                        <option value="1">Sản phẩm đơn giản</option>
                                        <option value="2">Sản phẩm biến thể</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hiden-properties d-none">
                                <div class="row m-0 h-100 ">
                                    <div class="col-md-3 bg-light border-right px-0">
                                        <ul>
                                            <li data-value="child_properties"
                                                class="px-2 py-3 text-primary border-bottom li active"
                                                style="cursor: pointer">Cách thuộc tính</li>
                                            <li data-value="child_variables"
                                                class="px-2 py-3 text-primary border-bottom li" style="cursor: pointer">
                                                Các
                                                biến thể</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9 px-0" id="child_properties">
                                        <div class="border-bottom py-2 px-3">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                id="add_properties">Thêm</button>
                                        </div>
                                        <div class="px-3 mt-3 d-none hidden-section">
                                            <div class="row">
                                                <label for="" class="form-label col-3">Tên: </label>
                                                <label for="" class="form-label col-9">Giá trị: </label>
                                            </div>
                                            <div id="property_container"></div>
                                            <div id="none"></div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mx-3 my-3"
                                            id="save_properties">Lưu thuộc
                                            tính</button>
                                    </div>
                                    <div class="col-md-9 px-0 d-none" id="child_variables">
                                        <div class="border-bottom py-2 px-3">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                id="add_variant">Thêm biến thể
                                                tự
                                                động</button>
                                        </div>
                                        <div id="variant_container" class="px-3 mt-3 my-3 d-none"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- End Content -->
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            var formSubmitting = false;
            var propertyCount = 0;
            var minImages = 0;
            var maxProperties = 2;
            var maxImages = 9;

            $('#customization_pro').on('change', function() {
                if ($(this).val() == 2) {
                    $('.hiden-properties').removeClass('d-none');
                } else {
                    $('.hiden-properties').addClass('d-none');
                }
            });

            $('#add_properties').on('click', function() {
                if (propertyCount < maxProperties) {
                    propertyCount++;
                    $('.hidden-section').removeClass('d-none');
                    var newSection = `
                        <div class="row my-2 property-row">
                            <div class="form-group col-3">
                                <select class="form-select property-name">
                                    <option value="" hidden>Tên thuộc tính</option>
                                    <option value="color">color</option>
                                    <option value="size">size</option>
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <input type="text" class="form-control property-value" placeholder="Giá trị thuộc tính (ví dụ: Xanh | Đỏ | Vàng)">
                            </div>
                            <div class="form-group col-1">
                                <button class="btn btn-sm btn-outline-danger remove-properties" type="button">X</button>
                            </div>
                        </div>
                    `;
                    $('#property_container').append(newSection);
                    updatePropertyOptions();
                } else {
                    alert('Tối đa là 2 thuộc tính');
                }
            });

            $('#property_container').on('click', '.remove-properties', function() {
                $(this).closest('.property-row').remove();
                propertyCount--;
                if (propertyCount === 0) {
                    $('.hidden-section').addClass('d-none');
                }
                updatePropertyOptions();
            });

            var _li = $('.li');
            _li.on('click', function() {
                _li.removeClass('active');
                $(this).addClass('active');

                var value = $(this).data('value');
                if (value == 'child_properties') {
                    $('#child_properties').removeClass('d-none');
                    $('#child_variables').addClass('d-none');
                } else {
                    $('#child_properties').addClass('d-none');
                    $('#child_variables').removeClass('d-none');
                }
            });

            $('#save_properties').on('click', function() {
                var propertyArrays = {};
                $('#property_container .row').each(function(index) {
                    var name = $(this).find('.property-name').val();
                    var valueInput = $(this).find('.property-value').val();

                    if (name && valueInput) {
                        var values = valueInput.split(' | ')
                        propertyArrays[name] = values;
                    }
                });

                if (Object.keys(propertyArrays).length === 0) {
                    alert("Vui lòng thêm ít nhất một thuộc tính với giá trị.");
                    return;
                }


                // Tạo các biến thể sản phẩm
                var variants = [];

                // Hàm đệ quy để tạo biến thể sản phẩm từ nhiều thuộc tính
                function generateVariants(keys, index, currentVariant) {
                    if (index === keys.length) {
                        variants.push(currentVariant);
                        return;
                    }
                    var key = keys[index];
                    propertyArrays[key].forEach(function(value) {
                        var newVariant = Object.assign({}, currentVariant);
                        newVariant[key] = value;
                        generateVariants(keys, index + 1, newVariant);
                    });
                }

                var keys = Object.keys(propertyArrays);
                generateVariants(keys, 0, {});


                // Hiển thị các biến thể sản phẩm
                $('#variant_container').empty();

                variants.forEach(function(variant) {
                    var row = $(
                        '<div class="mb-3 d-flex align-items-center justify-content-between"></div>'
                    );
                    var variantDescription = keys.map(key => variant[key]).join(' - ');

                    var variantDisplay = $( /*html*/ `
                    <div class="d-flex align-items-start">
                        ${keys.map(key => /*html*/`
                                                        <input class="btn btn-sm btn-primary mr-1"  name="variant_${key}[]"  value="${variant[key].trim()}"/>
                                                    `).join('')}
                    </div>
                    <div class="">
                        <input class="form-control form-control-sm" type="file" name="variant_image[]">
                    </div>
                    <div class="" >
                        <input class="form-control form-control-sm" type="number" name="variant_quantity[]" placeholder="Số lượng">
                    </div>
                    <div class="" >
                        <input class="form-control form-control-sm" type="number" name="variant_price[]" placeholder="Giá gốc" >
                    </div>
                    <div>
                        <input class="form-control form-control-sm" type="number" name="variant_sale_price[]" placeholder="Giá ưu đãi" >
                    </div>
                `);

                    row.append(variantDisplay);
                    $('#variant_container').append(row);
                });
            });

            $('#add_variant').on('click', function() {
                setTimeout(() => {
                    $('#variant_container').removeClass('d-none');
                }, 1500);
            });

            $('#product_form').on('submit', function() {
                formSubmitting = true; // Đặt formSubmitting thành true khi form được gửi đi
            });

            // Cảnh báo khi tải lại trang
            window.addEventListener('beforeunload', function(e) {
                if (!formSubmitting) {
                    var confirmationMessage = 'Changes you made may not be saved.';
                    (e || window.event).returnValue = confirmationMessage;
                    return confirmationMessage;
                }
            });

            function updatePropertyOptions() {
                // Lấy tất cả giá trị đã chọn
                var selectedValues = [];
                $('.property-name').each(function() {
                    var value = $(this).val();
                    if (value) {
                        selectedValues.push(value);
                    }
                });

                // Vô hiệu hóa các tùy chọn đã được chọn trong các trường chọn khác
                $('.property-name').each(function() {
                    var currentSelect = $(this);
                    currentSelect.find('option').each(function() {
                        var optionValue = $(this).val();
                        if (optionValue && selectedValues.includes(optionValue) && currentSelect
                            .val() !== optionValue) {
                            $(this).attr('disabled', true);
                        } else {
                            $(this).attr('disabled', false);
                        }
                    });
                });
            }

            // Gọi hàm khi giá trị thay đổi
            $('#property_container').on('change', '.property-name', function() {
                updatePropertyOptions();
            });

            $('#add_image').on('click', function() {
                minImages++;
                if (minImages < maxImages) {
                    var _html = /*html*/ `
                <div class="thumb-upload">
                    <div class="thumb-edit">
                        <input name="images[]" type="file" id="thumbUpload01" class="ec-image-upload" accept=".png, .jpg, .jpeg">
                        <label for="imageUpload"><img src="{{ asset('admin-assets/assets/img/icons/edit.svg') }}"
                        class="svg_img header_svg" alt="edit"></label>
                    </div>
                    <div class="thumb-preview ec-preview">
                    <div class="image-thumb-preview">
                    <img class="image-thumb-preview ec-image-preview"
                    src="{{ asset('admin-assets/assets/img/products/details-sm-2.png') }}" alt="edit">
                    </div>
                </div>
                </div>
                `;

                    $('.thumb-upload-set').append(_html);
                } else {
                    alert('Tối đa là 9 ảnh');
                }
            })
        });


        CKEDITOR.replace('description');
    </script>
@endsection
