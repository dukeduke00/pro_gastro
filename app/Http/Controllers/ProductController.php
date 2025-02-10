<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'fileToUpload' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Upload slike
        $imagePath = null;
        if ($request->hasFile('fileToUpload')) {
            $imagePath = $request->file('fileToUpload')->store('products', 'public');
        }

        // Kreiranje proizvoda u bazi
        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'brand' => $request->brand,
            'category' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath
        ]);

        return redirect()->route('product.create')->with('success', 'Product successfully added!');

    }
}
