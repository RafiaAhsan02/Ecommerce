<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubCategory(Request $request)
    {
        $category_id = $request->category_id;
        $subcategories = subCategory::where('category_id', $category_id)->get();
        $data = '<option value="" selected disabled>Select Subcategory</option>';
        foreach ($subcategories as $subcategory) {
            $data .='<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
        }
        return response()->json($data);
    }
}
