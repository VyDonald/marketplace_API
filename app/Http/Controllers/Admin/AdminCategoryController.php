<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name
        ]);

        // Retourner une réponse JSON pour AJAX
        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->name = $request->name;
        $category->save();

        // Retourner une réponse JSON pour AJAX
        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        // Retourner une réponse JSON pour AJAX
        return response()->json(['success' => true]);
    }

    public function show(Category $category)
{
    return response()->json($category);
}
}
