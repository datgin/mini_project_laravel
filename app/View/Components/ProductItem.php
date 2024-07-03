<?php

namespace App\View\Components;

use App\Helpers\ProductItemHelper;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductItem extends Component
{
    /**
     * Create a new component instance.
     */

     public $productItem;
    public function __construct()
    {
        $products = Product::with('variants')->get();

        $productsWithAttributes = $products->map(function ($product) {

            $prices = $product->variants->pluck('price')->values();
            $salePrices = $product->variants->pluck('sale_price')->values();
            return [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->name,
                'price' => $product->price,
                'discount' => $product->discount,
                'prices' => $prices,
                'salePrices' => $salePrices,
                'images' => $product->variants->pluck('image')->unique()->values(),
                'colors' => $product->variants->pluck('color')->unique()->values(),
                'sizes' => $product->variants->pluck('size')->unique(),
                'quantities' => $product->variants->pluck('quantity'),
            ];
        });

        $this->productItem = ProductItemHelper::renderProductItem($productsWithAttributes);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-item');
    }
}
