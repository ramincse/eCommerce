<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * = = = = = = = = = Sub Category = = = = = = = = =
     */
    //Sub Category Data View
    public function viewSubCategory()
    {
        $categories     = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategories  = SubCategory::latest()->get();
        return view('backend.category.sub_category_view', compact('subcategories', 'categories'));
    }

    //Sub Category Data Insert
    public function storeSubCategory(Request $request)
    {
        $this -> validate($request,
            [
                'subcategory_name_eng'    => 'required',
                'subcategory_name_bang'   => 'required',
                'category_id'        => 'required',
            ],
            [
                'subcategory_name_eng.required'     => 'Input SubCategory English Name',
                'subcategory_name_bang.required'    => 'Input SubCategory Bangla Name',
                'category_id.required'              => 'Please select category name',
            ]
        );

        SubCategory::insert([
            'subcategory_name_eng'    => $request->subcategory_name_eng,
            'subcategory_slug_eng'    => strtolower(str_replace(' ', '_', $request->subcategory_name_eng)),
            'subcategory_name_bang'   => $request->subcategory_name_bang,
            'subcategory_slug_bang'   => str_replace(' ', '_', $request->subcategory_name_bang),
            'category_id'             => $request->category_id,
        ]);

        $notification = [
            'message'    => 'SubCategory Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    //Sub Category Data Edit
    public function editSubCategory($id)
    {
        $categories     = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategory    = SubCategory::findOrFail($id);
        return view('backend.category.sub_category_edit', compact('subcategory', 'categories'));
    }

    //Sub Category Data Update
    public function updateSubCategory(Request $request)
    {
        $subcat_id  = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'subcategory_name_eng'    => $request->subcategory_name_eng,
            'subcategory_slug_eng'    => strtolower(str_replace(' ', '_', $request->subcategory_name_eng)),
            'subcategory_name_bang'   => $request->subcategory_name_bang,
            'subcategory_slug_bang'   => str_replace(' ', '_', $request->subcategory_name_bang),
            'category_id'             => $request->category_id,
        ]);

        $notification = [
            'message' => 'SubCategory Updated Successfully!',
            'alert-type' => 'info',
        ];

        return redirect()->route('all.subcategory')->with($notification);        
    }

    //Sub Category Data Delete
    public function deleteSubCategory($id)    
    {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message'    => 'SubCategory Deleted Successfully!',
            'alert-type' => 'info',
        ];

        return redirect() -> back() -> with($notification);
    }

    /**
     * = = = = = = = = = Sub SubCategory = = = = = = = = = 
     */
    //Sub SubCategory Data View
    public function viewSubSubCategory()
    {
        $categories     = Category::orderBy('category_name_eng', 'ASC')->get();
        $subsubcategories  = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }

    //Get Category Data By Ajax
    public function getSubCategory($category_id)
    {
        $sub_cat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_eng', 'ASC')->get();

        return json_encode($sub_cat);
    }

    //Get SubCategory Data By Ajax
    public function getSubSubCategory($subcategory_id)
    {
        $subsub_cat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_eng', 'ASC')->get();

        return json_encode($subsub_cat);
    }

    //Sub SubCategory Data Insert
    public function storeSubSubCategory(Request $request)
    {
        $this -> validate($request,
            [
                'subsubcategory_name_eng'   => 'required',
                'subsubcategory_name_bang'  => 'required',
                'category_id'               => 'required',
                'subcategory_id'            => 'required',
            ],
            [
                'subsubcategory_name_eng.required'      => 'Input Sub SubCategory English Name',
                'subsubcategory_name_bang.required'     => 'Input Sub SubCategory Bangla Name',
                'category_id.required'                  => 'Please select category name',
                'subcategory_id.required'               => 'Please select sub category name',
            ]
        );

        SubSubCategory::insert([
            'subsubcategory_name_eng'   => $request->subsubcategory_name_eng,
            'subsubcategory_slug_eng'   => strtolower(str_replace(' ', '_', $request->subsubcategory_name_eng)),
            'subsubcategory_name_bang'  => $request->subsubcategory_name_bang,
            'subsubcategory_slug_bang'  => str_replace(' ', '_', $request->subsubcategory_name_bang),
            'category_id'               => $request->category_id,
            'subcategory_id'            => $request->subcategory_id,
        ]);

        $notification = [
            'message'    => 'Sub SubCategory Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    //Sub SubCategory Data Edit
    public function editSubSubCategory($id)
    {
        $categories        = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategories     = SubCategory::orderBy('subcategory_name_eng', 'ASC')->get();
        $subsubcategories  = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('subsubcategories', 'categories', 'subcategories'));
    }

    //Sub SubCategory Data Update
    public function updateSubSubCategory(Request $request)
    {
        $subsubcat_id  = $request->id;

        $this -> validate($request,
            [
                'subsubcategory_name_eng'   => 'required',
                'subsubcategory_name_bang'  => 'required',
                'category_id'               => 'required',
                'subcategory_id'            => 'required',
            ],
            [
                'subsubcategory_name_eng.required'      => 'Input Sub SubCategory English Name',
                'subsubcategory_name_bang.required'     => 'Input Sub SubCategory Bangla Name',
                'category_id.required'                  => 'Please select category name',
                'subcategory_id.required'               => 'Please select sub category name',
            ]
        );

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'subsubcategory_name_eng'   => $request->subsubcategory_name_eng,
            'subsubcategory_slug_eng'   => strtolower(str_replace(' ', '_', $request->subsubcategory_name_eng)),
            'subsubcategory_name_bang'  => $request->subsubcategory_name_bang,
            'subsubcategory_slug_bang'  => str_replace(' ', '_', $request->subsubcategory_name_bang),
            'category_id'               => $request->category_id,
            'subcategory_id'            => $request->subcategory_id,
        ]);

        $notification = [
            'message' => 'Sub SubCategory Updated Successfully!',
            'alert-type' => 'info',
        ];

        return redirect()->route('all.subsubcategory')->with($notification);        
    }

    //Sub SubCategory Data Delete
    public function deleteSubSubCategory($id)    
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Sub SubCategory Deleted Successfully!',
            'alert-type' => 'info',
        ];

        return redirect() -> back() -> with($notification);
    }
}
