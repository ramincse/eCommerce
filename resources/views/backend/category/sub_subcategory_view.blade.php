@extends('admin.admin_master')
@section('admin')
<!-- jQuery JS -->
<script src="{{ asset('backend/js/download/jquery.min.js') }}"></script>
<!-- Sweet Alert JS -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub->SubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Sub SubCategory Eng</th>
                                        <th>Sub SubCategory Bang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subsubcategories as $item)  
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item['category']['category_name_eng'] }}</td>
                                        <td>{{ $item['subcategory']['subcategory_name_eng'] }}</td>
                                        <td>{{ $item->subsubcategory_name_eng }}</td>
                                        <td>{{ $item->subsubcategory_name_bang }}</td>
                                        <td width="18%">
                                            <a class="btn btn-info" href="{{ route('subsubcategory.edit', $item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a id="delete" class="btn btn-danger" href="{{ route('subsubcategory.delete', $item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add Sub->SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('subsubcategory.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group">
                                            <h5>Category Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="category_id" class="form-control" aria-invalid="false">
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

                                        <div class="form-group">
                                            <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subcategory_id" class="form-control" aria-invalid="false">
                                                    <option value="" selected="" disabled>Select SubCategory</option>                                                                                                        
                                                </select>
                                                @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Sub -> SubCategory Name English<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="subsubcategory_name_eng" class="form-control" />
                                                @error('subsubcategory_name_eng')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <h5>Sub -> SubCategory Name Bangla<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="subsubcategory_name_bang" class="form-control" />
                                                @error('subsubcategory_name_bang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                            
                                        </div>                                        
    
                                        <div class="text-xs-right mb-2">
                                            <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Add New">
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
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();

            if(category_id){
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
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
    });
</script>
@endsection   