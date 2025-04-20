<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::withTrashed()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        try {
            $file_path = $this->uploadMedia($request);

            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'url' => $request->url,
                'image' => $file_path,
                'status' => $request->status
            ]);
            notyf()->success('Slider updated successfully.');
            return redirect()->route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        try {
            $slider = Slider::findOrFail($id);

            if ($request->hasFile('image')) {
                $file_path = $this->uploadMedia($request, $slider);
            } else {
                $file_path = $slider->image;
            }

            $slider->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'url' => $request->url,
                'image' => $file_path,
                'status' => $request->status
            ]);
            notyf()->success('Slider created successfully.');
            return redirect()->route('admin.slider.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /*
     * Trash (soft delete) the specified resource from listing.
     */
    public function trash(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        notyf()->success('Slider trashed successfully.');
        return redirect()->route('admin.slider.index');
    }

    /*
     * Restore the specified resource.
     */
    public function restore(string $id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);
        $slider->restore();
        notyf()->success('Slider restored successfully.');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);

        if (isset($slider->image) && File::exists(public_path($slider->image))) {
            unlink($slider->image);
        }
        $slider->forceDelete();
        notyf()->success('Slider deleted successfully.');
        return redirect()->route('admin.slider.index');
    }

    /*
     *Upload images with preset properties
     */
    protected function uploadMedia($request, $oldData = null)
    {
        if ($request->hasFile('image')) {
            $imgDriver = new ImageManager(new Driver());
            $image = $imgDriver->read($request->file('image'));
            $image->cover(1980, 630);
            $image->toWebp();
            $imageName = time() . rand(0000, 9999) . '.webp';
            if (isset($oldData->image) && File::exists(public_path($oldData->image))) {
                unlink($oldData->image);
            }
            $image->save('uploads/slider/' . $imageName);
            return 'uploads/slider/' . $imageName;
        }
    }
}
