<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Show products list
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('products.list', compact('products'));
    }

    // Show create product page
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withInput()
                ->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // Handle image upload to public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;     // store relative path
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

            $product = Product::findOrFail($id);
            $product->name = $request->input('name');
            $product->sku = $request->input('sku');
            $product->price = $request->input('price');
            $product->description = $request->input('description');

        // Update image if a new one is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $product->image = 'images/' . $imageName;
            }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete    product    (placeholder)
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image)); // remove image from public folder
        }

        $product->delete();


        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
