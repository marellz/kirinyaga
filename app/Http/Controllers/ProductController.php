<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category = null, $subcategory = null)
    {
        //
        $products = Product::where('visible', true);

        if ($category) {
            $products = $products->where('category_id', $category);

            if ($subcategory) {
                // todo: subcat must have matching parent cat
                $products = $products->where('subcategory_id', $subcategory);
            }
        }

        return view('products.list', [
            'products' => $products->paginate(),
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('products.form', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'short_info' => 'required|string|max:1024',
            'category_id' => 'exists:categories|required',
            'subcategory_id' => 'exists:subcategories',
            'price' => 'number|required',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ]);

        $request->merge(['slug' => Str::slug($request->get('title'))]);

        $created = Product::create($request->only([
            "name",
            "slug",
            "short_info",
            "category_id",
            "subcategory_id",
            "price",
            "description",
            "in_stock",
            "visible",
        ]));

        return view('products', ['product' => 'product', 'success' => $created]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        if (!$product->exists()) {
            abort(404);
        }
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        if (!$product->exists()) {
            abort(404);
        }

        return view('products.show', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        if (!$product->exists()) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'short_info' => 'required|string|max:1024',
            'category_id' => 'exists:categories|required',
            'subcategory_id' => 'exists:subcategories',
            'price' => 'number|required',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ]);

        $request->merge(['slug' => Str::slug($request->get('title'))]);

        $updated = Product::create($request->only([
            "name",
            "slug",
            "short_info",
            "category_id",
            "subcategory_id",
            "price",
            "description",
            "in_stock",
            "visible",
        ]));

        if (!$updated) {
            abort(500, 'Error updating product');
        }

        return view('products.show', ['product' => $product, 'message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        if (!$product->exists()) {
            abort(404);
        }

        try {
            //code...
        } catch (\Throwable $th) {
        }

        foreach ($product->photos as $photo) {
            $photo->delete();
            # code...
        }

        $deleted = $product->delete();

        if ($deleted) {
            abort(500, 'Error deleting product');
        }

        return redirect()->route('products', ['message' => 'Product successfully deleted']);
    }
}
