<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $brands     = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function storeProduct(Request $request)
    {
        $image      = $request->file('product_thumbnail');
        $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url   = 'upload/products/thumbnail/' . $name_gen;

        //Data Insert
        $product_id = Product::insertGetId([
            'brand_id'          => $request->brand_id,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_eng'  => $request->product_name_eng,
            'product_slug_eng'  => strtolower(str_replace(' ', '_', $request->product_name_eng)),
            'product_name_bang' => $request->product_name_bang,
            'product_slug_bang' => str_replace(' ', '_', $request->product_name_bang),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tag_eng'   => $request->product_tag_eng,
            'product_tag_bang'  => $request->product_tag_bang,
            'product_size_eng'  => $request->product_size_eng,
            'product_size_bang' => $request->product_size_bang,
            'product_color_eng' => $request->product_color_eng,
            'product_color_bang' => $request->product_color_bang,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_descp_eng'   => $request->short_descp_eng,
            'short_descp_bang'  => $request->short_descp_bang,
            'long_descp_eng'    => $request->long_descp_eng,
            'long_descp_bang'   => $request->long_descp_bang,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            'product_thumbnail' => $save_url,
            'status'            => 1,
            'created_at'        => Carbon::now(),
        ]);

        //Multiple Image Upload
        $images      = $request->file('multi_img');
        foreach($images as $img){
            $make_name   = hexdec(uniqid()) . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath   = 'upload/products/multi-image/' . $make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'message' => 'Product Inserted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    //Manage Product
    public function manageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    //Edit Product
    public function editProduct($id)
    {
        $multiimg = MultiImg::where('product_id', $id)->get();

        $categories     = Category::latest()->get();
        $brands         = Brand::latest()->get();
        $subcategory    = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products       = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiimg'));
    }

    //Product Update
    public function updateProduct(Request $request)
    {
        //Get ID
        $product_id = $request->id;

        //Data Update
        Product::findOrFail($product_id)->update([
            'brand_id'          => $request->brand_id,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_eng'  => $request->product_name_eng,
            'product_slug_eng'  => strtolower(str_replace(' ', '_', $request->product_name_eng)),
            'product_name_bang' => $request->product_name_bang,
            'product_slug_bang' => str_replace(' ', '_', $request->product_name_bang),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tag_eng'   => $request->product_tag_eng,
            'product_tag_bang'  => $request->product_tag_bang,
            'product_size_eng'  => $request->product_size_eng,
            'product_size_bang' => $request->product_size_bang,
            'product_color_eng' => $request->product_color_eng,
            'product_color_bang' => $request->product_color_bang,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_descp_eng'   => $request->short_descp_eng,
            'short_descp_bang'  => $request->short_descp_bang,
            'long_descp_eng'    => $request->long_descp_eng,
            'long_descp_bang'   => $request->long_descp_bang,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            //'product_thumbnail' => $save_url,
            'status'            => 1,
            'created_at'        => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Product Updated Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    //Multiple Image Update
    public function multiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            
            $make_name   = hexdec(uniqid()) . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath   = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'message'       => 'Product Image Updated Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification);
    }

    //Delete Multi Image
    public function deleteMultiImage($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = [
            'message'       => 'Product Image Deleted Successfully!',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    //Thumbnail Image Updated 
    public function thumbnailImageUpdate(Request $request)
    {
        $pro_id     = $request->id;   
        $old_img    = $request->old_img; 
        unlink($old_img);  

        //New Image
        $image      = $request->file('product_thumbnail');
        $name_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url   = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Product Thumbnail Updated Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification);
    }

    //Inactive Product
    public function inactiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = [
            'message'       => 'Product Inactive Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification);
    }

    //Active Product
    public function activeProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = [
            'message'       => 'Product Activated Successfully!',
            'alert-type'    => 'info',
        ];

        return redirect()->back()->with($notification); 
    }

    //Product Delete
    public function deleteProduct($id)
    {
        //Single Image
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        //Multi Image
        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = [
            'message'       => 'Product Deleted Successfully!',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification); 
    }

}
