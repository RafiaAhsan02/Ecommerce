<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return $categories = DB::table('categories')->get();
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
        ]);

        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Category created successfully.');
            return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // $category = Category::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug, ' . $category->id . '|max:255',
        ]);

        try {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Category updated successfully.');
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        notyf()->success('Category deleted successfully.');
        return redirect()->route('admin.category.index');
    }
}
