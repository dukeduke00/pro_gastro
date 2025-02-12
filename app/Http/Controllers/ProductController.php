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

    public function single(Products $id)
    {
        return view('product.single', compact('id'));
    }

    public function delete(Products $id)
    {
        $id->delete();

        return redirect('/');
    }

    public function edit(Products $id)
    {
        return view('product.edit', compact('id'));
    }

    public function save(Request $request, Products $id)
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


        // Ako postoji fajl, čuvamo putanju slike
        if ($request->hasFile('fileToUpload')) {
            $imagePath = $request->file('fileToUpload')->store('products', 'public');
            $id->image = $imagePath; // Čuvamo novu putanju slike
        }

        // Ispravljeno dohvaćanje podataka iz request-a
        $id->name = $request->input('name');
        $id->description = $request->input('description');
        $id->quantity = $request->input('quantity'); // Ispravljena greška ('amount' → 'quantity')
        $id->brand = $request->input('brand');
        $id->category = $request->input('category');
        $id->price = $request->input('price');

        $id->save();

        return redirect('/');
    }



}
