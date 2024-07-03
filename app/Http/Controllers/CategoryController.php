<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;

class CategoryController extends Controller
{
    public function categories($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $categories = $category->descendantsAndSelf($category->id)->pluck('id')->all();

        if (count($categories) > 1) {
            $category_id = Category::whereIn('parent_id', $categories)->pluck('id')->all();
        }

        $products = Product::whereIn('category_id', $category_id ?? $categories)->get();

        $productID = $products->pluck('id')->all();

        $variants = Product::with('variants')->whereIn('id', $productID)->get();

        $productsWithAttributes = $variants->map(function ($product) {

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

        return view('pages.products', compact('productsWithAttributes'));
    }
}
