@extends('admin.admin_master')
@section('admin')   
<!-- jQuery JS -->
<script src="{{ asset('backend/js/download/jquery.min.js') }}"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"> <!-- novalidate -->
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Brand Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" class="form-control" aria-invalid="false" required>
                                                <option value="" selected="" disabled>Select Brand</option>
                                                @foreach ($brands as $item)
                                                <option value="{{ $item->id }}">{{ $item->brand_name_eng }}</option>
                                                @endforeach                                                    
                                            </select>
                                            @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" aria-invalid="false" required>
                                                <option value="" selected="" disabled>Select Category</option>
                                                @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name_eng }}</option>
                                                @endforeach                                                    
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" aria-invalid="false" required>
                                                <option value="" selected="" disabled>Select SubCategory</option>                                                  
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subsubcategory_id" class="form-control" aria-invalid="false" required>
                                                <option value="" selected="" disabled>Select Sub-SubCategory</option>                                                    
                                            </select>
                                            @error('subsubcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_eng" class="form-control" required>
                                        </div>
                                        @error('product_name_eng')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Name Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_bang" class="form-control" required>
                                        </div>
                                        @error('product_name_bang')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control" required>
                                        </div>
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_qty" class="form-control" required>
                                        </div>
                                        @error('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Tags English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_tag_eng" type="text" value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_tag_eng')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Tags Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_tag_bang" type="text" value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_tag_bang')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Size English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_size_eng" type="text" value="Large,Medium,Small" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_size_eng')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Size Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_size_bang" type="text" value="বড়,মাঝারি,ছোট" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_size_bang')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Color English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_color_eng" type="text" value="Red,Black,White" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_color_eng')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Color Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input name="product_color_bang" type="text" value="লাল,কালো,সাদা" data-role="tagsinput" placeholder="add tags" required>
                                        </div>
                                        @error('product_color_bang')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="selling_price" class="form-control" required>
                                        </div>
                                        @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="discount_price" class="form-control" required>
                                        </div>
                                        @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)" required>
                                        </div>
                                        @error('product_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img id="mainThumb" src="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Multiple Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" required>
                                        </div>
                                        @error('multi_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="row" id="preview_img">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Short Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_eng" class="form-control" required></textarea>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Short Description Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_bang" class="form-control" required></textarea>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Long Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="long_descp_eng" class="form-control" required></textarea>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Long Description Bangla <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor2" name="long_descp_bang" class="form-control" required></textarea>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">                                        
                                        <div class="controls">
                                            <fieldset>
                                                <input name="hot_deals" type="checkbox" id="checkbox_2" value="1" />
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input name="featured" type="checkbox" id="checkbox_3" value="1" />
                                                <label for="checkbox_3">Featured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">                                        
                                        <div class="controls">
                                            <fieldset>
                                                <input name="special_offer" type="checkbox" id="checkbox_4" value="1" />
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input name="special_deals" type="checkbox" id="checkbox_5" value="1" />
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right mb-2">
                                <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Add Product">
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>    
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //Sub Category
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_eng + '</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });

        //Sub SubCategory
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id){
                $.ajax({
                    url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_eng + '</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });        
    });

    //Main Thumbnail Image Load
    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<script type="text/javascript"> 
//Multiple Image Upload
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });     
</script>
@endsection   