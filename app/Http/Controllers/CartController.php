<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productID = $request->input('product_id');
        $image = $request->input('image');
        $quantity = $request->input('quantity', 1);
        $color = $request->input('color');
        $size = $request->input('size');

        $product = Product::find($productID);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cart = session()->get('cart', []);

        $variantKey = $productID . '-' . Str::slug($color) . '-' . $size;

        if (isset($cart[$variantKey])) {
            $cart[$variantKey]['quantity'] += $quantity;
        } else {
            $cart[$variantKey] = [
                'name' => $product->name,
                'image' => $image,
                'price' => $product->price ? $product->price : ($product->price * (1 - $product->discount)),
                'quantity' => $quantity,
                'color' => $request->input('color'),
                'size' => $request->input('size'),
            ];
        }

        $cart = array_merge([$variantKey => $cart[$variantKey]], $cart);

        session()->put('cart', $cart);
        return response()->json(['success' => true, 'count' => count($cart), 'cart' => session()->get('cart')]);
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
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $cartID = $request->input('cart_id');
            $quantity = $request->input('quantity');

            $cart = session()->get('cart', []);

            $cart[$cartID]['quantity'] = $quantity;

            session()->put('cart', $cart);

            return response()->json(['success' => true, 'count' => count($cart), 'cart' => session()->get('cart')]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $cartID = $request->input('cart_id');

        $cart = session()->get('cart', []);

        unset($cart[$cartID]);

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'count' => count($cart), 'cart' => session()->get('cart')]);
    }
}
