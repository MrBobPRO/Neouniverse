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
}
