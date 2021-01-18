<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add_category(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|string|min:2|max:20',
        ]);
        Category::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->back();
    }
    public function get_category_products($category_id)
    {
        $products = Product::whereHas('categories', function($query) use ($category_id) {
            $query->where('category_id', '=', $category_id);
        })->with('categories')->get();
        return view('products', [
            'products' => $products,
        ]);
    }
}
