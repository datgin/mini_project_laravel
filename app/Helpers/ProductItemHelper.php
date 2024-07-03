<?php

namespace App\Helpers;

class ProductItemHelper
{
    public static function renderProductItem($products)
    {
        $html = '';
        foreach ($products as $product) {
            $html .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 ec-product-content" data-animation="fadeIn">
                        <div class="ec-product-inner">
                            <div class="ec-pro-image-outer">
                                <div class="ec-pro-image">
                                    <a href="" class="image">
                                        <img class="main-image" src="' . asset($product['images'][0]) . '" alt="Product" />
                                        <img class="hover-image" src="' . asset($product['images'][1]) . '" alt="Product" />
                                    </a>
                                    <span class="percentage">20%</span>
                                    <a href="#" class="quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                    <div class="ec-pro-actions">
                                        <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                        <button title="Add To Cart" class="add-to-cart" data-id="' . $product['id'] . '"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                        <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-pro-content">
                                <h5 class="ec-pro-title"><a href="' . route('product.detail', $product['slug']) . '" id="pro-name">' . $product['name'] . '</a></h5>
                                <div class="ec-pro-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>
                                <span class="ec-price">
                                    <span class="old-price">$' . number_format($product['price'], 0, '', '.') . '</span>
                                    <span class="new-price">$' . number_format($product['price'] * (1 - $product['discount']), 0, '', '.') . '</span>
                                </span>
                                <div class="ec-pro-option">
                                    <div class="ec-pro-color">
                                        <span class="ec-pro-opt-label">Color</span>
                                        <ul class="ec-opt-swatch ec-change-img">';
            foreach ($product['images'] as $key => $image) {
                $html .= '<li id="pro-color" data-color="' . $product['colors'][$key] . '" data-image="' . $image . '">
                                                            <a href="#" class="ec-opt-clr-img" data-src="' . asset($image) . '" data-src-hover="' . asset($image) . '" data-tooltip="Image">
                                                                <img src="' . asset($image) . '" alt="Product Image">
                                                            </a>
                                                        </li>';
            }
            $html .= '</ul>
                                    </div>
                                    <div class="ec-pro-size">
                                        <span class="ec-pro-opt-label">Size</span>
                                        <ul class="ec-opt-size">';
            foreach ($product['sizes'] as $key => $size) {
                $html .= '<li id="pro-size" data-size="' . $size . '">
                                                            <a href="#" class="ec-opt-sz" data-tooltip="Small">' . $size . '</a>
                                                        </li>';
            }
            $html .= '</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        return $html;
    }
}
