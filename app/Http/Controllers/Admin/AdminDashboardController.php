<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Products::count();
        $categoriesCount = Category::count();
        $productImageCount = ProductImages::count();
        $latestProducts = Products::with('category')->orderBy('created_at', 'desc')->take(5)->get();
        $categoriesData = Category::withCount('products')->get()->pluck('products_count', 'name')->toArray();

        // Nouvelle stat : Moyenne d'images par produit
        $averageImagesPerProduct = $productsCount > 0 
            ? round($productImageCount / $productsCount, 2) 
            : 0;

        // Nouvelle stat : Utilisateurs actifs (exemple : connectés dans les 7 derniers jours)
        $activeUsersCount = User::where('updated_at', '>=', now()->subDays(7))->count();

        return view('admin.dashboard', compact(
            'usersCount',
            'productsCount',
            'categoriesCount',
            'productImageCount',
            'latestProducts',
            'categoriesData',
            'averageImagesPerProduct',
            'activeUsersCount'
        ));
    }
}