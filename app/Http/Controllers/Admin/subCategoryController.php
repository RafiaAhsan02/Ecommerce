<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = subCategory::with('category')->get();
        return view('admin.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug|max:255',
        ]);

        try {
            subCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Subcategory created successfully.');
            return redirect()->route('admin.subcategory.index');
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
        $data['subCategory'] = subCategory::findOrFail($id);
        $data['categories'] = Category::get();
        return view('admin.subcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = subCategory::findOrFail($id);

        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug, ' . $subCategory->id . '|max:255',
        ]);

        try {
            $subCategory->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Subcategory updated successfully.');
            return redirect()->route('admin.subcategory.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = subCategory::findOrFail($id);

        $subCategory->delete();
        notyf()->success('Subcategory deleted successfully.');
        return redirect()->route('admin.subcategory.index');
    }
}
