<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Announce;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request) 
    {
        $kategoriId = $request->input('kategori');

        $categories = Category::all();
        $query = Product::query();
        $announc = Announce::all();
    
        if ($kategoriId) {
            $query->where('kategori_produk', $kategoriId);
        }
    
        $product = $query->get();
    
        return view('index', compact('product', 'categories', 'announc'));
    }

    public function show(Product $product) 
    {
        return view('product.show', compact('product'));
    }
}
