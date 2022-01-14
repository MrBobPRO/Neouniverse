<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Product;
use App\Models\ProductsCategory;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use stdClass;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // filtering products because request may contain searching && filtering && orderring
        $products = $this->filter($request);
        $products->withPath(route('products.index'));

        $productsCount = Product::all()->count();

        $locale = App::currentLocale();
        $categories = ProductsCategory::orderBy($locale . '_name', 'asc')->get();
        $symptoms = Symptom::orderBy($locale . '_name', 'asc')->get();
        $forms = Form::orderBy($locale . '_name', 'asc')->get();

        return view('products.index', compact('products', 'productsCount', 'categories', 'symptoms', 'forms', 'request'));
    }

    public function single($url)
    {
        $product = Product::where('url', $url)->first();
        $product_categories = $product->categories()->pluck('id')->toArray();

        $similar_products = Product::whereHas('categories', function($q) use ($product_categories) {
            $q->whereIn('id', $product_categories); })
            ->where('id', '!=', $product->id)
            ->get();

        return view('products.single', compact('product', 'similar_products'));
    }

    public function ajax_get(Request $request)
    {
        $products = $this->filter($request);
        $products->withPath(route('products.index'));

        return view('components.products.list', compact('products'));
    }

    private function filter(Request $request)
    {
        /**
         * Used for filtering products in products.index route and while filteing products by ajax
         * return filtered && ordered && paginated products list 
         * @param \Illuminate\Http\Request $request
         * @return Illuminate\Database\Eloquent\Builder
         */
        $locale = App::currentLocale();
        $products = Product::query();
        
        if($request->prescription != 'all' && $request->prescription != '') {
            $products = $products->where('prescription', $request->prescription);
        }

        $keyword = $request->keyword;
        if($keyword) {
            $products = $products->where(function ($q) use($locale, $keyword) {
                $q->where($locale . '_name', 'like', '%' . $keyword . '%')
                ->orWhere($locale . '_description', 'like', '%' . $keyword . '%')
                ->orWhere($locale . '_composition', 'like', '%' . $keyword . '%')
                ->orWhere($locale . '_testimony', 'like', '%' . $keyword . '%');
            });
        }

        $category_id = $request->category_id;
        if($category_id) {
            $products = $products->whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        $symptom_id = $request->symptom_id;
        if($symptom_id) {
            $products = $products->whereHas('symptoms', function ($q) use ($symptom_id) {
                $q->where('id', $symptom_id);
            });
        }

        if($request->form_id) {
            $products = $products->where('form_id', $request->form_id);
        }

        $products = $products->orderBy($locale . '_name', 'asc')
                    ->select('id', $locale . '_name', $locale . '_description', $locale . '_image', 'prescription', 'url')
                    ->paginate(12)
                    ->appends($request->except(['page','_token']))
                    ->fragment('all_products');

        return $products;
    }

    public function download_instructions(Request $request)
    {
        $product = Product::find($request->id);
        $locale = App::currentLocale();
        $instruction = public_path('instructions/' . $locale . '/' . $product[$locale . '_instruction']);

        return response()->download($instruction, $product[$locale . '_instruction']);
    }
}
