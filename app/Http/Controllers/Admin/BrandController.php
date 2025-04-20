<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $file_path = $this->uploadMedia($request);

            Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $file_path,
            ]);
            notyf()->success('Brand created successfully.');
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $brand->id . '|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file_path = $this->uploadMedia($request, $brand);
            } else {
                $file_path = $brand->image;
            }
            $brand->update([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $file_path,
            ]);

            notyf()->success('Brand updated successfully.');
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        if (File::exists(public_path($brand->image))) {
            unlink($brand->image);
        }

        $brand->delete();
        notyf()->success('Brand deleted successfully.');
        return redirect()->route('admin.brand.index');
    }

    /*
     *Upload images with preset properties
     */
    protected function uploadMedia($request, $brand = null)
    {
        if ($request->hasFile('image')) {
            $imgDriver = new ImageManager(new Driver());
            $image = $imgDriver->read($request->file('image'));
            $image->cover(150, 150);
            $image->toWebp();
            $imageName = time() . rand(0000, 9999) . '.webp';
            if (isset($brand->image) && File::exists(public_path($brand->image))) {
                unlink($brand->image);
            }
            $image->save('uploads/brand/' . $imageName);
            return 'uploads/brand/' . $imageName;
        }
    }
}
