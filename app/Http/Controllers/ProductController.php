<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function products()
    {


        return view('pages.products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $variants = $product->variants;

        $variants_color = $variants->pluck('color')->unique()->values();

        $variants_image = $variants->pluck('image')->unique()->values();

        $variants_sizes = $variants->pluck('size')->unique()->values();

        $images = ProductImage::where('product_id', $product->id)->get();

        return view('pages.product-detail', compact('product', 'images', 'variants_image', 'variants_sizes', 'variants_color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getVariantByColor(Request $request)
{
    if ($request->ajax()) {
        // Initialize $variants_image to handle cases where it's not set
        $variants_image = collect();

        // Get all variants with the given product_id and color or size
        $variants = Variant::where('product_id', $request->idPro)
            ->where($request->color ? 'color' : 'size', $request->color ? $request->color : $request->size)
            ->get();

        // Get unique sizes if color is set, otherwise get unique colors
        if ($request->color) {
            $data = $variants->pluck('size')->unique()->values();
        } else {
            $data = $variants->pluck('color')->unique()->values();
            $variants_image = $variants->pluck('image')->unique()->values();
        }

        // Get quantities from the filtered variants
        $variant_quantity = $variants->pluck('quantity');

        return response()->json([
            'data' => $data,
            'variants_image' => $variants_image,
            'variant_quantity' => $variant_quantity
        ]);
    }

    return response()->json(['error' => 'Invalid request'], 400);
}

}
