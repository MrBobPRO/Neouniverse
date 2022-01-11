<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Product;
use App\Models\ProductsCategory;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12);
        $productsCount = Product::all()->count();

        $locale = App::currentLocale();
        $categories = ProductsCategory::orderBy($locale . '_name', 'asc')->get();
        $symptoms = Symptom::orderBy($locale . '_name', 'asc')->get();
        $forms = Form::orderBy($locale . '_name', 'asc')->get();

        return view('products.index', compact('products', 'productsCount', 'categories', 'symptoms', 'forms'));
    }

    public function single($url)
    {
        $product = Product::where('url', $url)->first()->get();

        return view('products.single', compact('product'));
    }

    public function filter(Request $request)
    {
        /**
         * return filtered & ordered & paginated products list 
         */

        $locale = App::currentLocale();
        $products = Product::query();
        
        if($request->prescription != 'all') {
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
                    ->paginate(12);

        return view('components.products.list', compact('products'));
    }
}
