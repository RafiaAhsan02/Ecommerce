<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;

class HomeProductController extends Controller
{
    public function productDetail($slug)
    {
        $product = Product::with('brand:id,name,slug', 'productImages')->where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        $relatedProducts = Product::select('id', 'brand_id', 'category_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name,slug', 'productImages')
            ->where('status', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->get();
        $product->increment('view_count');
        return view('frontend.product_detail', compact('product', 'relatedProducts'));
    }

    public function products()
    {
        $data['products'] = Product::select('id', 'brand_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name,slug')
            ->with(array(
                'productImages' => function ($query) {
                    $query->limit(2);
                }
            ))
            ->latest()
            ->where('status', true)
            ->paginate(12);
        return view('frontend.shop', $data);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function brandProduct($slug)
    {
        $brand = Brand::where('slug', $slug)->first();

        $products = Product::select('id', 'brand_id', 'category_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name,slug', 'productImages')
            ->where('status', true)
            ->where('brand_id', $brand->id)
            ->paginate(12);
        return view('frontend.shop', compact('products'));
    }

    public function categoryProduct($category, $subCategory = null)
    {
        if (isset($category) && $subCategory != null) {
            $subCategory = subCategory::where('slug', $subCategory)->first();
            $data['products'] = Product::where('sub_category_id', $subCategory->id)->active()->paginate(12);
        } else {
            $data['products'] = Category::where('slug', $category)->first()->products()->active()->paginate(12);
        }

        if (!$data['products']) {
            abort(404);
        }

        // $data['topRatedProducts'] = Product::withCount('orders')->orderBy('orders_count', 'DESC')->active()->paginate(12);
        return view('frontend.shop', $data);
    }
}
