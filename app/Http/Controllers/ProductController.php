<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /*
        1 - index() -- senarai produk
        2 - edit() -- form edit produk
        3 - store() -- save from new produk form
        4 - create() -- add new form
        5 - update() -- save from edit form
        6 - destroy() -- delete produk
    */

    // senarai produk
    public function index(Request $request) {

        $query = Product::query(); 

        if($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->paginate(10)->appends(['search' => $request->search ]);

        return view('product.index', compact('products'));
    }

    // edit form 
    public function edit($id) {
        $product = Product::findOrFail($id);
        // dd($product);

        return view('product.edit', compact('product'));
    }

    // create form
    public function create() {
        return view('product.create');
    }

    // save from edit form
    public function update(Request $request, $id) {

        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:5|max:255', 
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:1000'   
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if($request->hasFile('photo')) {
            $product->photo = $request->file('photo')->store('product-photos', 'public');
        }

        $product->save();

        return redirect()->route('product.index')
            ->with('success','Product updated successfully');
    }

    // save for create form
    public function store(Request $request) {

        $request->validate([
            'name' => 'required|min:5|max:255', 
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0'       
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description
        ]);

        return redirect()->route('product.index')
            ->with('success','Product added successfully');

    }

    // delete produk
    public function destroy() {

    }

}
