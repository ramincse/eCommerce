@extends('admin.admin_master')
@section('admin')   
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Icon</th>
                                        <th>Category Name Eng</th>
                                        <th>Category Name Bang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)  
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><span><i class="{{ $item->category_icon }}"></i></span></td>
                                        <td>{{ $item->category_name_eng }}</td>
                                        <td>{{ $item->category_name_bang }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('category.edit', $item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a id="delete" class="btn btn-danger" href="{{ route('category.delete', $item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            {{-- Add Brand Page --}}
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group">
                                            <h5>Category Name English<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_name_eng" class="form-control" />
                                                @error('category_name_eng')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <h5>Category Name Bangla<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_name_bang" class="form-control" />
                                                @error('category_name_bang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                            
                                        </div>

                                        <div class="form-group">
                                            <h5>Category Icon<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_icon" class="form-control" />
                                                @error('category_icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                            
                                        </div>
    
                                        <div class="text-xs-right mb-2">
                                            <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Add Category">
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