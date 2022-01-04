<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class MainController extends Controller
{
    public function home()
    {
        $products = Product::inrandomOrder()->take(8)->get();
        $news = News::latest()->take(4)->get();

        return view('home.index', compact('products', 'news'));
    }

    public function about_us()
    {
        return view('about.index');
    }

}
