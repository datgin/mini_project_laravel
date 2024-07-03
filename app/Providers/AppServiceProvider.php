<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();



        // $products = Product::with('variants')->get();

        // $productsWithAttributes = $products->map(function ($product) {

        //     $prices = $product->variants->pluck('price')->values();
        //     $salePrices = $product->variants->pluck('sale_price')->values();
        //     return [
        //         'id' => $product->id,
        //         'slug' => $product->slug,
        //         'name' => $product->name,
        //         'price' => $product->price,
        //         'discount' => $product->discount,
        //         'prices' => $prices,
        //         'salePrices' => $salePrices,
        //         'images' => $product->variants->pluck('image')->unique()->values(),
        //         'colors' => $product->variants->pluck('color')->unique()->values(),
        //         'sizes' => $product->variants->pluck('size')->unique(),
        //         'quantities' => $product->variants->pluck('quantity'),
        //     ];
        // });

        // $views = ['pages.products'];


        // view()->composer($views, function ($view) use ($productsWithAttributes) {
        //     $view->with('products', $productsWithAttributes);
        // });
    }
}
