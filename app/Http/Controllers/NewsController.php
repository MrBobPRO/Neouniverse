<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // filtering products because request may contain searching && filtering && orderring
        $news = $this->filter($request);
        $news->withPath(route('news.index'));

        $newsCount = News::all()->count();

        $locale = App::currentLocale();
        $categories = NewsCategory::orderBy($locale . '_name', 'asc')->get();

        return view('news.index', compact('news', 'newsCount', 'categories', 'request'));
    }

    public function single($url)
    {
        $new = News::where('url', $url)->first();
        $news_categories = $new->categories()->pluck('id')->toArray();

        $similar_news = News::whereHas('categories', function($q) use ($news_categories) {
            $q->whereIn('id', $news_categories); })
            ->where('id', '!=', $new->id)
            ->take(8)
            ->paginate(12);

        return view('news.single', compact('new', 'similar_news'));
    }

    public function ajaxGet(Request $request)
    {
        $news = $this->filter($request);
        $news->withPath(route('news.index'));

        return view('components.news.list', compact('news'));
    }

    private function filter(Request $request)
    {
        /**
         * Used for filtering news in news.index route and while filteing news by ajax
         * return filtered && ordered && paginated news list 
         * @param \Illuminate\Http\Request $request
         * @return Illuminate\Database\Eloquent\Builder
         */
        $locale = App::currentLocale();
        $news = News::query();

        $keyword = $request->keyword;
        if($keyword) {
            $news = $news->where(function ($q) use($locale, $keyword) {
                $q->where($locale . '_title', 'like', '%' . $keyword . '%')
                ->orWhere($locale . '_body', 'like', '%' . $keyword . '%');
            });
        }

        $category_id = $request->category_id;
        if($category_id) {
            $news = $news->whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        $news = $news->latest()
                    ->select('id', $locale . '_title', $locale . '_body', 'image', 'url')
                    ->paginate(12)
                    ->appends($request->except(['page','_token']))
                    ->fragment('all_news');

        return $news;
    }

    public function dashboardIndex(Request $request)
    {
        //used in search
        $items = News::orderBy('ru_title')
            ->select('id', 'ru_title as title')
            ->get();
        $singleRoute = 'dashboard.news.single';

        $itemsCount = News::all()->count();

        // Generate default parameters for ordering/filtering request
        $orderBy = $request->orderBy ? $request->orderBy : 'ru_title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $news = News::orderBy($orderBy, $orderType)
        ->paginate(30, ['*'], 'page', $activePage)
        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.news.index', compact('itemsCount', 'items', 'singleRoute', 'news', 'orderType', 'activePage', 'orderBy', 'reversedOrderType'));
    }

    public function dashboardCreate()
    {
        $categories = NewsCategory::orderBy('ru_name', 'asc')->get();

        return view('dashboard.news.create', compact('categories', 'forms'));
    }

    public function dashboardSingle($id)
    {
        $product = Product::find($id);

        $categories = ProductsCategory::orderBy('ru_name', 'asc')->get();
        $symptoms = Symptom::orderBy('ru_name', 'asc')->get();
        $forms = Form::orderBy('ru_name', 'asc')->get();

        return view('dashboard.products.single', compact('product', 'symptoms', 'categories', 'forms'));
    }

    public function store(Request $request)
    {
        $validation_rules = [
            Helper::DEFAULT_LANGUAGE . "name" => "unique:products"
        ];

        $validation_messages = [
            Helper::DEFAULT_LANGUAGE . "name.unique" => "Продукт с таким названием уже существует !",
        ];

        Validator::make($request->all(), $validation_rules, $validation_messages)->validate();

        $product = new Product();

        $multiLanguageFields = ['name', 'obtain_link', 'amount', 'description', 'composition', 'testimony', 'use'];
        Helper::fillMultiLanguageFields($request, $product, $multiLanguageFields);

        $product->url = Helper::transliterateIntoLatin($request->ru_name);
        $product->prescription = $request->prescription;
        $product->form_id = $request->form_id;

        Helper::uploadProductInstructions($request, $product);
        Helper::uploadProductImages($request, $product);

        $product->save();

        $product->categories()->attach($request->categories);
        $product->symptoms()->attach($request->symptoms);

        return redirect()->route('dashboard.index');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;

        // escape duplicate product name
        $validationErrors = [];
        if($request[$defaultLanguage . 'name'] != $product[$defaultLanguage . 'name']) {
            $duplicate = Product::where($defaultLanguage . 'name', $request[$defaultLanguage . 'name'])->first();
            if ($duplicate) array_push($validationErrors, "Продукт с таким названием уже существует!");
        }

        if(count($validationErrors) > 0) return back()->withInput()->withErrors($validationErrors);

        $multiLanguageFields = ['name', 'obtain_link', 'amount', 'description', 'composition', 'testimony', 'use'];
        Helper::fillMultiLanguageFields($request, $product, $multiLanguageFields);

        $product->url = Helper::transliterateIntoLatin($request->ru_name);
        $product->prescription = $request->prescription;
        $product->form_id = $request->form_id;

        Helper::uploadProductInstructions($request, $product);
        Helper::uploadProductImages($request, $product);

        $product->save();

        $product->categories()->detach();
        $product->categories()->attach($request->categories);

        $product->symptoms()->detach();
        $product->symptoms()->attach($request->symptoms);

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $this->delete([$request->id]);

        return redirect()->route('dashboard.index');
    }

    public function removeMultiple(Request $request)
    {
        $this->delete($request->ids);

        return redirect()->back();
    }

    /**
     * Delete selected items
     * @param array $ids
     * @return void
     */
    public function delete($ids)
    {
        foreach($ids as $id) {
            $product = Product::find($id);
            $product->categories()->detach();
            $product->symptoms()->detach();
            $product->delete();
        }
    }

}
