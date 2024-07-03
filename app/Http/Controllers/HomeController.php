<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
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

        return view('pages.home', compact('productsWithAttributes'));
    }

    public function checkAvailability(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size');
        $color = $request->input('color');

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['available' => false]);
        }

        // Kiểm tra sự tồn tại của biến thể với size và color nếu có
        if ($size && $color) {
            $variant = $product->variants()->where('size', $size)->where('color', $color)->first();
        } else {
            $variant = $product->variants()->first();
        }

        if ($variant && $variant->quantity > 0) {
            return response()->json(['available' => true]);
        } else {
            return response()->json(['available' => false]);
        }
    }
}
