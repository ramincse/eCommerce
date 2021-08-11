@extends('admin.admin_master')
@section('admin')    
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Profile Edit</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin User Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin User E-mail<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="email" class="form-control" required="" value="{{ $editData->email }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Profile Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input id="image" type="file" name="profile_photo_path" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="showImage" class="rounded-circle" src="{{ (!empty($editData->profile_photo_path)) ? url('upload/admin_images/' . $editData->profile_photo_path) : url('upload/avatar.jpg') }}" style="width: 100px; height: 100px;" />
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input class="btn btn-rounded btn-primary mb-5" type="submit" value="Update">
                                    </div>
                                </div> 
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
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection