<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class ProductController extends Controller
{
public function index()
{
    $cakeCategory = Category::where('name', 'Cakes')->first();
    $cakeProducts = $cakeCategory ? $cakeCategory->products()->take(8)->get() : collect();

    $pastryCategory = Category::where('name', 'Pastries')->first();
    $pastryProducts = $pastryCategory ? $pastryCategory->products()->get() : collect();


    return view('products.index', [
        'cakeProducts' => $cakeProducts,       
        'cakeCategory' => $cakeCategory, 
        'pastryProducts' => $pastryProducts,       
        'pastryCategory' => $pastryCategory, 
    
    ]);
}
    
}
