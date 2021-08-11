@extends('admin.admin_master')
@section('admin')   
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            {{-- Add Brand Page --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub-SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('subsubcategory.update') }}" method="POST">
                                @csrf
                                <input name="id" type="hidden" value="{{ $subsubcategories->id }}">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group">
                                            <h5>Category Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="category_id" class="form-control" aria-invalid="false">
                                                    <option value="" selected="" disabled>Select Category</option>
                                                    @foreach ($categories as $item)
                                                    <option {{ $item->id == $subsubcategories->category_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->category_name_eng }}</option>
                                                    @endforeach                                                    
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subcategory_id" class="form-control" aria-invalid="false">
                                                    <option value="" selected="" disabled>Select SubCategory</option> 
                                                    @foreach ($subcategories as $sub_item)
                                                    <option {{ $sub_item->id == $subsubcategories->subcategory_id ? 'selected' : '' }} value="{{ $sub_item->id }}">{{ $sub_item->subcategory_name_eng }}</option>
                                                    @endforeach                                                                                                        
                                                </select>
                                                @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Sub -> SubCategory Name English<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="subsubcategory_name_eng" class="form-control" value="{{ $subsubcategories->subsubcategory_name_eng }}"/>
                                                @error('subsubcategory_name_eng')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <h5>Sub -> SubCategory Name Bangla<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="subsubcategory_name_bang" class="form-control" value="{{ $subsubcategories->subsubcategory_name_bang }}"/>
                                                @error('subsubcategory_name_bang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                            
                                        </div>                                        
    
                                        <div class="text-xs-right mb-2">
                                            <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Update Category">
                                        </div>

                                    </div> 
                                </div>                            
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection   