<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $selectedCategoryId = $request->input('category_id');

        if ($selectedCategoryId) {
            $selectedCategory = Category::findOrFail($selectedCategoryId);
            $descendantIds = $selectedCategory->subcategories->pluck('id');

            $products = Product::whereIn('category_id', $descendantIds)->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::doesntHave('subcategories')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        $categories = Category::doesntHave('subcategories')->get();
        return view('products.create',compact('categories'))->with('success','مبروك يا حبيبى');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $product = Product::with('category')->findOrFail($id);

        // Pass the product to the view
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        // Fetch all categories for the dropdown selection
        $categories = Category::all();

        // Pass the product and categories to the view
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Ensure the category_id exists in the categories table
        ]);

        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Update the product with the validated data
        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);

        // Redirect to the product details page or any other appropriate page
        return redirect()->route('products.index', ['product' => $product->id])
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
