<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
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

        $similar_products = Product::whereHas('categories', function ($q) use ($product_categories) {
            $q->whereIn('id', $product_categories);
        })
            ->where('id', '!=', $product->id)
            ->get();

        return view('products.single', compact('product', 'similar_products'));
    }

    public function ajaxGet(Request $request)
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

        if ($request->prescription != 'all' && $request->prescription != '') {
            $products = $products->where('prescription', $request->prescription);
        }

        $keyword = $request->keyword;
        if ($keyword) {
            $products = $products->where(function ($q) use ($locale, $keyword) {
                $q->where($locale . '_name', 'like', '%' . $keyword . '%')
                    ->orWhere($locale . '_description', 'like', '%' . $keyword . '%')
                    ->orWhere($locale . '_composition', 'like', '%' . $keyword . '%')
                    ->orWhere($locale . '_testimony', 'like', '%' . $keyword . '%');
            });
        }

        $category_id = $request->category_id;
        if ($category_id) {
            $products = $products->whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        $symptom_id = $request->symptom_id;
        if ($symptom_id) {
            $products = $products->whereHas('symptoms', function ($q) use ($symptom_id) {
                $q->where('id', $symptom_id);
            });
        }

        if ($request->form_id) {
            $products = $products->where('form_id', $request->form_id);
        }

        $products = $products->orderBy($locale . '_name', 'asc')
            ->select('id', $locale . '_name', $locale . '_description', $locale . '_image', 'prescription', 'url')
            ->paginate(12)
            ->appends($request->except(['page', '_token']))
            ->fragment('all_products');

        return $products;
    }

    public function downloadInstructions(Request $request)
    {
        $product = Product::find($request->id);
        $locale = App::currentLocale();
        $instruction = public_path('instructions/' . $locale . '/' . $product[$locale . '_instruction']);

        return response()->download($instruction, $product[$locale . '_instruction']);
    }

    public function dashboardIndex(Request $request)
    {
        //used in search
        $items = Product::orderBy('ru_name')
            ->select('id', 'ru_name as title')
            ->get();
        $singleRoute = 'dashboard.products.single';

        $itemsCount = Product::all()->count();

        // Generate default parameters for ordering/filtering request
        $orderBy = $request->orderBy ? $request->orderBy : 'ru_name';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $products = Product::orderBy($orderBy, $orderType)
        ->paginate(30, ['*'], 'page', $activePage)
        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.products.index', compact('itemsCount', 'items', 'singleRoute', 'products', 'orderType', 'activePage', 'orderBy', 'reversedOrderType'));
    }

    public function dashboardCreate()
    {
        $categories = ProductsCategory::orderBy('ru_name', 'asc')->get();
        $symptoms = Symptom::orderBy('ru_name', 'asc')->get();
        $forms = Form::orderBy('ru_name', 'asc')->get();

        return view('dashboard.products.create', compact('symptoms', 'categories', 'forms'));
    }

    public function dashboardSingle($id)
    {
        $product = Product::find($id);

        return view('dashboard.products.single', compact('product'));
    }

    public function store(Request $request)
    {
        /**
         * Only RU fields are required
         * RU values used as default value for EN/KA values
         */
        $product = new Product();

        $multiLanguageFields = ['name', 'obtain_link', 'amount', 'description', 'composition', 'testimony', 'use'];
        Helper::fillMultiLanguageFields($product, $multiLanguageFields, $request);

        $product->url = Helper::transliterateIntoLatin($request->ru_name);
        $product->prescription = $request->prescription;
        $product->form_id = $request->form_id;
        
        Helper::storeProductInstructions($product, $request);
        Helper::storeProductImages($product, $request);

        dd($product);
    }

}
