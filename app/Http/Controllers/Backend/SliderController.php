<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //Show Slider
    public function viewSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));  
    }
    
    //
    public function storeSlider(Request $request)
    {
        $this -> validate($request, [
            'slider_img'    => 'required'
        ],
        [
            'slider_img.required'    => 'Please select a image',
        ]
        );

        $image      = $request->file('slider_img');
        $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(870,370)->save('upload/slider/' . $name_gen);
        $save_url   = 'upload/slider/' . $name_gen;

        Slider::insert([
            'slider_img'    => $save_url,
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        $notification = [
            'message' => 'Slider Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    //Edit Slider
    public function editSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }

    //Slider Update
    public function updateSlider(Request $request)
    {
        $slider_id  = $request->id;
        $old_image  = $request->old_image;

        if($request->file('slider_img')){
            unlink($old_image);
            $image      = $request->file('slider_img');
            $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(870,370)->save('upload/slider/' . $name_gen);
            $save_url   = 'upload/slider/' . $name_gen;

            Slider::findOrFail($slider_id)->update([
                'slider_img'    => $save_url,
                'title'         => $request->title,
                'description'   => $request->description,
            ]);

            $notification = [
                'message' => 'Slider Updated Successfully!',
                'alert-type' => 'success',
            ];    
            return redirect()->route('manage.slider')->with($notification);
        }else{
            Slider::findOrFail($slider_id)->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);

            $notification = [
                'message' => 'Slider Updated Successfully!',
                'alert-type' => 'info',
            ];
    
            return redirect()->route('manage.slider')->with($notification);
        }
    }

    //Delete Slider
    public function deleteSlider($id)    
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);

        Slider::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Slider Deleted Successfully!',
            'alert-type' => 'info',
        ];
        return redirect()->back()->with($notification);
    }

    //Inactive Slider
    public function inactiveSlider($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        $notification = [
            'message'       => 'Product Inactive Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification);
    }

    //Active Slider
    public function activeSlider($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        $notification = [
            'message'       => 'Slider Activated Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification); 
    }
}
