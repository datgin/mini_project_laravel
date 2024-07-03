<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();



        return view('admin.product.add-product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    function getImageHash($image)
    {
        return md5_file($image->getPathname());
    }

    public function store(Request $request)
    {

        $variant_color = $request->input('variant_color');
        $variant_size = $request->input('variant_size');
        $variant_quantity = $request->input('variant_quantity');
        $variant_price = $request->input('variant_price');
        $variant_sale_price = $request->input('variant_sale_price');


        $variant_image = [];
        $uploaded_images = [];

        foreach ($request->file('variant_image') as $key => $image) {
            $image_hash = $this->getImageHash($image);

            if (!array_key_exists($image_hash, $uploaded_images)) {
                $filename = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $image->move('images/variant/', $filename);

                $uploaded_images[$image_hash] = 'images/variant/' . $filename;
            }

            $variant_image[$key] = $uploaded_images[$image_hash];
        }


        // cách 1: lưu public
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path =  $image->move('images/product/', $filename);
            // $path = $image->storeAs('public/images/product', $filename);
        }

        // cách 2: lưu storage
        // php artisan storage:link
        // <img src="{{ asset('storage/images/' . $image) }}" alt="Uploaded Image">
        // $imageName = time() . '.' . $request->image->extension();
        // $request->image->storeAs('public/images', $imageName);


        $product = Product::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'image' => $path,
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status') ? 1 : 0,
        ]);

        for ($i = 0; $i < count($variant_color); $i++) {
            Variant::create([
                'product_id' => $product->id,
                'color' => $variant_color[$i],
                'size' => $variant_size[$i],
                'image' => $variant_image[$i],
                'quantity' => $variant_quantity[$i],
                'price' => $variant_price[$i] ?? $request->input('price'),
                'sale_price' => $variant_sale_price[$i],
            ]);
        }



        foreach ($request->file('images')  as $key => $image) {

            $filename = time() . $key . '.' . $image->getClientOriginalExtension();
            $image->move('images/product/', $filename);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => 'images/product/' . $filename
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
