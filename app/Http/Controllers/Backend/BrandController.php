<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function viewBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $this -> validate($request, [
            'brand_name_eng'    => 'required',
            'brand_name_bang'   => 'required',
            'brand_image'       => 'required',
        ],
        [
            'brand_name_eng.required'    => 'Input Brand English Name',
            'brand_name_bang.required'   => 'Input Brand Bangla Name',
        ]
        );

        $image      = $request->file('brand_image');
        $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(300,300)->save('upload/brand/' . $name_gen);
        $save_url   = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name_eng'    => $request->brand_name_eng,
            'brand_slug_eng'    => strtolower(str_replace(' ', '_', $request->brand_name_eng)),
            'brand_name_bang'   => $request->brand_name_bang,
            'brand_slug_bang'   => str_replace(' ', '_', $request->brand_name_bang),
            'brand_image'       => $save_url,
        ]);

        $notification = [
            'message' => 'Brand Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function updateBrand(Request $request)
    {
        $brand_id  = $request->id;
        $old_image = $request->old_image;

        if($request->file('brand_image')){
            unlink($old_image);
            $image      = $request->file('brand_image');
            $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(300,300)->save('upload/brand/' . $name_gen);
            $save_url   = 'upload/brand/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_eng'    => $request->brand_name_eng,
                'brand_slug_eng'    => strtolower(str_replace(' ', '_', $request->brand_name_eng)),
                'brand_name_bang'   => $request->brand_name_bang,
                'brand_slug_bang'   => str_replace(' ', '_', $request->brand_name_bang),
                'brand_image'       => $save_url,
            ]);

            $notification = [
                'message' => 'Brand updated successfully!',
                'alert-type' => 'info',
            ];
    
            return redirect()->route('all.brand')->with($notification);
        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_eng'    => $request->brand_name_eng,
                'brand_slug_eng'    => strtolower(str_replace(' ', '_', $request->brand_name_eng)),
                'brand_name_bang'   => $request->brand_name_bang,
                'brand_slug_bang'   => str_replace(' ', '_', $request->brand_name_bang),
            ]);

            $notification = [
                'message' => 'Brand Updated Successfully!',
                'alert-type' => 'info',
            ];
    
            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function deleteBrand($id)    
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Brand Deleted Successfully!',
            'alert-type' => 'info',
        ];

        return redirect() -> back() -> with($notification);
    }
}
