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
                        <h3 class="box-title">Edit Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="id" type="hidden" value="{{ $brand->id }}">
                                <input name="old_image" type="hidden" value="{{ $brand->brand_image }}">
                                <div class="form-group">
                                    <h5>Brand Name English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_eng" class="form-control" value="{{ $brand->brand_name_eng }}"/>
                                        @error('brand_name_eng')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <h5>Brand Name Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_bang" class="form-control" value="{{ $brand->brand_name_bang }}"/>
                                        @error('brand_name_bang')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                            
                                </div>

                                <div class="form-group">
                                    <h5>Brand Image<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="brand_image" class="form-control" />
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mb-2">
                                    <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Update Brand">
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