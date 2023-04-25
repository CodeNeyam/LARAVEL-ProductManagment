<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $products = Product::when($search, function ($query, $search) {
                    return $query->where('name', 'like', '%'.$search.'%')
                                 ->orWhere('description', 'like', '%'.$search.'%');
                })
                ->paginate(5);
                
    return view('products.index', compact('products'));
}


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
    
        $product = new Product($request->all());
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
    $request->validate([
        'name' => 'required|max:255',
        'description' => 'nullable|max:1000',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
    ]);

    $product->fill($request->all());
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
