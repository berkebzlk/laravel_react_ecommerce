<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index')->with([
            'products' => Product::with(['colors', 'sizes'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.create')->with([
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        if ($request->validated()) {
            $data = $request->all();
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));

            if ($request->has('first_image')) {
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            if ($request->has('second_image')) {
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            if ($request->has('third_image')) {
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            $data['slug'] = Str::slug($request->name);
            $product = Product::create($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);

            return redirect()->route('admin.products.index')->with([
                'success' => 'Product has been added successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.edit')->with([
            'colors' => $colors,
            'sizes' => $sizes,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->validated()) {
            $data = $request->all();

            if ($request->has('thumbnail')) {
                $this->removeProductImageFromStorage($request->file('thumbnail'));
                $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            }


            if ($request->has('first_image')) {
                $this->removeProductImageFromStorage($request->file('first_image'));
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            if ($request->has('second_image')) {
                $this->removeProductImageFromStorage($request->file('second_image'));
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            if ($request->has('third_image')) {
                $this->removeProductImageFromStorage($request->file('third_image'));
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            $data['slug'] = Str::slug($request->name);
            $product->update($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);

            return redirect()->route('admin.products.index')->with([
                'success' => 'Product has been updated successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->removeProductImageFromStorage($product->thumbnail);
        $this->removeProductImageFromStorage($product->first_image);
        $this->removeProductImageFromStorage($product->second_image);
        $this->removeProductImageFromStorage($product->third_image);

        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'success' => 'Product has been deleted successfully'
        ]);
    }

    /**
     * save product images in the storage
     */
    public function saveImage($file)
    {
        $image_name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('images/products/', $image_name, 'public');
        return 'storage/images/products/' . $image_name;
    }

    /**
     * remove product images from the storage
     */
    public function removeProductImageFromStorage($file)
    {
        $path = public_path('storage/images/products/', $file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
