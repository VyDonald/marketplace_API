<?php

namespace App\Http\Controllers;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ProductImages::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $uploadedImages = [];
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('product_images', 'public');
                    
                    $uploadedImages[] = ProductImages::create([
                        'product_id' => $request->product_id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
            
            return response()->json($uploadedImages, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = ProductImages::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        
        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
