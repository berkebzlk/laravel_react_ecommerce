<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * get all the products
     */
    public function index() {
        return ProductResource::collection(
            Product::with(['colors','sizes','reviews'])
                ->latest()
                ->get()
                ->additional([
                    'colors' => Color::has('product')->get(),
                    'sizes' => Size::has('product')->get(),
                ])
        );
    }

    /**
     * get product by slug
     */
    public function show(Product $product) {
        return ProductResource::make(
            $product->load(['colors','sizes','reviews'])
        );
    }

    /**
     * filter products by color
     */
    public function filterProductsByColor(Color $color) {
        return ProductResource::collection(
            $color->products()
                ->with(['colors','sizes','reviews'])
                ->latest()
                ->get()
                ->additional([
                    'colors' => Color::has('product')->get(),
                    'sizes' => Size::has('product')->get(),
                ])
        );
    }

    /**
     * filter products by size
     */
    public function filterProductsBySize(Size $size) {
        return ProductResource::collection(
            $size->products()
                ->with(['colors','sizes','reviews'])
                ->latest()
                ->get()
                ->additional([
                    'colors' => Color::has('product')->get(),
                    'sizes' => Size::has('product')->get(),
                ])
        );
    }

    /**
     * filter products by term
     */
    public function findProductsByTerm(string $searchTerm) {
        return ProductResource::collection(
            Product::where('name','LIKE','%'.$searchTerm.'%')
                ->with(['colors','sizes','reviews'])
                ->latest()
                ->get()
                ->additional([
                    'colors' => Color::has('product')->get(),
                    'sizes' => Size::has('product')->get(),
                ])
        );
    }
}
