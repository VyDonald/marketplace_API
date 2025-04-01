<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;

class AdminProductImageController extends Controller
{
    public function index()
    {
        $productImages = ProductImages::with('product')->get();
        $products = Products::all(); // Pour le formulaire d'ajout
        return view('admin.product_images.index', compact('productImages', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        $path = $request->file('image')->store('product_images', 'public');
        $productImage = ProductImages::create([
            'product_id' => $request->product_id,
            'image_path' => $path,
        ]);

        return response()->json([
            'id' => $productImage->id,
            'product_id' => $productImage->product_id,
            'image_path' => asset('storage/' . $path),
            'product_name' => $productImage->product->name,
        ]);
    }

    public function destroy(ProductImages $productImage)
    {
        Storage::disk('public')->delete($productImage->image_path);
        $productImage->delete();
        return response()->json(['success' => true]);
    }

    public function show(ProductImages $productImage)
    {
        $productImage->load('product');
        return response()->json([
            'id' => $productImage->id,
            'product_id' => $productImage->product_id,
            'image_path' => asset('storage/' . $productImage->image_path),
            'product_name' => $productImage->product->name,
        ]);
    }
}