<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Create a variable to hold all the products currently in the db
        $products = Product::latest()->paginate(5);

        //return the view that has all the products
        return view('products.index', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validating user input
        $request ->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        //creating a new product in db
        Product::create($request->all()); 

        return redirect()->route('products.index')
                        ->with('success','Product created successfully');                       
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         //validating user input
         $request ->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        //Updating a product in db
        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Deleting product from the db
        $product->delete();
        
        //Return to the product index view
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
