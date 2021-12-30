<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $products = Product::inrandomOrder()->take(8)->get();
        // $news = News::latest()->take(4)->get();

        return view('home.index', compact('products'));
    }
}
