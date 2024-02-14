<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
    public function create(Request $request)
    {
        //
        $categories = Category::all();
        $product = new Product();

        return view('products.form', ['categories' => $categories, 'product' => $product]);
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
            'category_id' => 'required|exists:categories,id|',
            'subcategory_id' => 'exists:subcategories,id',
            'price' => 'required|numeric',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ]);


        $request->merge(['slug' => Str::slug($request->get('name'))]);

        $product = Product::create($request->only([
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

        return redirect()
            ->route('products')
            ->with('message', 'Successfully added!');;
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

        $categories = Category::all();

        return view('products.form', ['product' => $product, 'categories' => $categories]);
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
            'name' => 'required|string|max:255',
            'short_info' => 'required|string|max:1024',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'exists:subcategories,id',
            'price' => 'required|numeric',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ]);

        $request->merge(['slug' => Str::slug($request->get('name'))]);

        $updated = $product->update($request->only([
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

        return redirect()
            ->route('product.show', [$product])
            ->with('status', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        if (!$product) {
            abort(404);
        }

        foreach ($product->photos as $photo) {
            $photo->delete();
        }
        
        $deleted = $product->delete();

        if (!$deleted) {
            abort(500, 'Error deleting product');
        }

        return redirect()
            ->route('products')
            ->with('message', 'Product successfully deleted');
    }
}
