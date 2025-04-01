<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductImages;

class DashboardController extends Controller
{
    /**
     * Tableau de bord principal pour l'administration
     */
    public function index()
    {
        $totalProducts = Products::count();
        $totalCategories = Category::count();
        $totalImages = ProductImages::count();
        
        $recentProducts = Products::with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentCategories = Category::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalImages' => $totalImages,
            'recentProducts' => $recentProducts,
            'recentCategories' => $recentCategories
        ]);
    }
}