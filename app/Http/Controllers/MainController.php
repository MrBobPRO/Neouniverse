<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function home()
    {
        $products = Product::inrandomOrder()->take(8)->get();
        $news = News::latest()->take(4)->paginate(12);

        return view('home.index', compact('products', 'news'));
    }

    public function aboutUs()
    {
        return view('about.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $locale = App::currentLocale();

        $products = Product::where($locale . '_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere($locale . '_description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere($locale . '_composition', 'LIKE', '%' . $keyword . '%')
                        ->orWhere($locale . '_testimony', 'LIKE', '%' . $keyword . '%')
                        ->orWhere($locale . '_use', 'LIKE', '%' . $keyword . '%')
                        ->select(
                            $locale . '_name as title', 
                            $locale . '_description as text', 
                            'url')
                        ->orderBy('title')->get();

        $news = News::where($locale . '_title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere($locale . '_body', 'LIKE', '%' . $keyword . '%')
                        ->select(
                            $locale . '_title as title',
                            $locale . '_body as text',
                            'url')
                        ->orderBy('title')->get();

        $resultsCount = count($products) + count($news);
        $noResultsText = __('По вашему запросу ничего не найдено') . '!';

        return [
            'news' => $news,
            'products' => $products,
            'resultsCount' => $resultsCount,
            'noResultsText' => $noResultsText,
            'productsUrl' => route('products.index'),
            'newsUrl' => route('news.index')
        ];
    }

    public function emailFeedback(Request $request)
    {
        Mail::to('boburjon_n@mail.ru')->send(new Feedback($request));

        return redirect()->back();
    }

}
