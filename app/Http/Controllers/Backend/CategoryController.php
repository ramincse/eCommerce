<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function viewCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $this -> validate($request,
            [
                'category_name_eng'    => 'required',
                'category_name_bang'   => 'required',
                'category_icon'        => 'required',
            ],
            [
                'category_name_eng.required'    => 'Input Category English Name',
                'category_name_bang.required'   => 'Input Category Bangla Name',
                'category_icon.required'        => 'Input Category Icon',
            ]
        );

        Category::insert([
            'category_name_eng'    => $request->category_name_eng,
            'category_slug_eng'    => strtolower(str_replace(' ', '_', $request->category_name_eng)),
            'category_name_bang'   => $request->category_name_bang,
            'category_slug_bang'   => str_replace(' ', '_', $request->category_name_bang),
            'category_icon'        => $request->category_icon,
        ]);

        $notification = [
            'message'    => 'Category Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $category_id  = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name_eng'    => $request->category_name_eng,
            'category_slug_eng'    => strtolower(str_replace(' ', '_', $request->category_name_eng)),
            'category_name_bang'   => $request->category_name_bang,
            'category_slug_bang'   => str_replace(' ', '_', $request->category_name_bang),
            'category_icon'        => $request->category_icon,
        ]);

        $notification = [
            'message' => 'Category Updated Successfully!',
            'alert-type' => 'info',
        ];

        return redirect()->route('all.category')->with($notification);        
    }

    public function deleteCategory($id)    
    {
        Category::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Category Deleted Successfully!',
            'alert-type' => 'info',
        ];

        return redirect() -> back() -> with($notification);
    }
}
