<?php
namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::where('status', true)->get();
        $data['brands'] = Brand::get();
        $data['newProducts'] = Product::select('id', 'brand_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name,slug')
            ->with(array(
                'productImages' => function ($query) {
                    $query->limit(2);
                }
            ))
            ->latest()->take(10)
            ->where('status', true)
            ->get();

        $data['featuredProducts'] = Product::select('id', 'brand_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name,slug')
            ->with(array(
                'productImages' => function ($query) {
                    $query->limit(2);
                }
            ))
            ->latest()->take(20)
            ->where('status', true)
            ->where('is_featured', true)
            ->get();
        return view('frontend.home', $data);

    }
    public function managerDashboard()
    {
        return view('manager.dashboard');
    }
}
