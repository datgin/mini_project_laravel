<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $PATH_VIEW = 'product.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        return view($this->PATH_VIEW . __FUNCTION__, compact('product', 'images', 'variants_image', 'variants_sizes', 'variants_color'));
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
            // Lấy tất cả các biến thể có color và product_id theo yêu cầu
            $variants = Variant::where('product_id', $request->idPro)
                                ->where('color', $request->color)
                                ->get();
    
            // Lấy các kích thước duy nhất từ các biến thể đã lọc
            $variants_size = $variants->pluck('size')->unique()->values();
    
            // Lấy số lượng từ các biến thể đã lọc
            $variant_quantity = $variants->pluck('quantity');
    
            return response()->json([
                'variants_size' => $variants_size,
                'variant_quantity' => $variant_quantity
            ]);
        }
    }
}
