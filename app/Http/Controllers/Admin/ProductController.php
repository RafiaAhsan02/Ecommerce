<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\subCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::get();
        $products = Product::withTrashed()->select('id', 'category_id', 'sub_category_id', 'brand_id', 'name', 'price', 'discount', 'discount_price', 'quantity', 'is_featured', 'status', 'deleted_at')
            ->with('category', 'subCategory', 'brand:id,name')
            ->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::get();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        if ($request->discount) {
            $discountPrice = $request->price - ($request->price * $request->discount) / 100;
        }

        $product = Product::create([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? null,
            'discount_price' => $discountPrice ?? null,
            'quantity' => $request->quantity,
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ]);

        $imageData = [];

        if ($files = $request->file('images')) {

            if (!File::exists(public_path('uploads/product'))) {
                mkdir(public_path('uploads/product'), 0777, true);
            }

            foreach ($files as $key => $file) {
                $imgDriver = new ImageManager(new Driver());
                $image = $imgDriver->read($file);
                $image->cover(540, 560);
                $image->toWebp();
                $imageName = 'product_' . time() . rand(0000, 9999) . '.webp';
                $path = 'uploads/product/' . $imageName;
                $image->save($path);
                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path,
                ];
            }
        }
        ProductImage::insert($imageData);
        notyf()->success('Product created successfully.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category', 'subCategory', 'brand:id,name', 'productImages')->withTrashed()->findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('productImages')->withTrashed()->findOrFail($id);
        $categories = Category::get();
        $subCategories = subCategory::where('category_id', $product->category_id)->get();
        $brands = Brand::get();
        return view('admin.product.edit', compact('product', 'categories', 'subCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($request->discount) {
            $discountPrice = $request->price - ($request->price * $request->discount) / 100;
        }

        $product->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? null,
            'discount_price' => $discountPrice ?? null,
            'quantity' => $request->quantity,
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ]);

        $imageData = [];

        if ($files = $request->file('images')) {
            foreach ($files as $key => $file) {
                $imgDriver = new ImageManager(new Driver());
                $image = $imgDriver->read($file);
                $image->cover(540, 560);
                $image->toWebp();
                $imageName = 'product_' . time() . rand(0000, 9999) . '.webp';
                $path = 'uploads/product/' . $imageName;
                $image->save($path);
                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path,
                ];
            }
        }

        if ($files = $request->file('images')) {
            $productImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($productImages as $key => $value) {
                if (!in_array($value->image, $files)) {
                    if (File::exists(public_path($value->image))) {
                        File::delete(public_path($value->image));
                    }
                    $value->delete();
                }
            }
        }

        // insert new images
        ProductImage::insert($imageData);

        notyf()->success('Product updated successfully.');
        return redirect()->route('admin.product.index');
    }

    /*
     * Trash (soft delete) the specified resource from listing.
     */
    public function trash(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        notyf()->success('Product trashed successfully.');
        return redirect()->route('admin.product.index');
    }

    /*
     * Restore the specified resource.
     */
    public function restore(string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        notyf()->success('Product restored successfully.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('productImages')->withTrashed()->findOrFail($id);

        if (count($product->productImages) > 0) {
            foreach ($product->productImages as $key => $value) {
                if (File::exists(public_path($value->image))) {
                    File::delete(public_path($value->image));
                }
            }
        }

        $product->forceDelete();
        notyf()->success('Product has been permanently deleted.');
        return redirect()->route('admin.product.index');
    }
}
