<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();

        $productsWithAttributes = $products->map(function ($product) {

            $prices = $product->variants->pluck('price')->values();
            $salePrices = $product->variants->pluck('sale_price')->values();
            return [
                'slug' => $product->slug,
                'name' => $product->name,
                'price' => $product->price,
                'discount' => $product->discount,
                'prices' => $prices,
                'salePrices' => $salePrices,
                'images' => $product->variants->pluck('image')->unique()->values(),
                'colors' => $product->variants->pluck('color')->unique(),
                'sizes' => $product->variants->pluck('size')->unique(),
            ];
        });

        return view('index', compact('productsWithAttributes'));
    }

}
