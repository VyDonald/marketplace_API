<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categories()
    {
        return response()->json(Category::all(), 200);
    }

    public function products(Request $request)
    {
        $query = Products::with('category', 'images');
        
        // Filtrage par catégorie
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Recherche par nom
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }
        
        // Pagination
        $products = $query->paginate(10);
        
        return response()->json($products, 200);
    }

    public function productDetail($id)
    {
        $product = Products::with('category', 'images')->findOrFail($id);
        return response()->json($product, 200);
    }
}
