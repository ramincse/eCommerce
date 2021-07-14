@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-2">
                <br>
                <img class="card-img-top" style="border-radius: 50%;" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/avatar.jpg') }}" width="100%" height="100%">
                <br><br>
                <ul class="list-group list-group-flush">
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard') }}">Home</a>
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Profile Update</a>
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('change.password') }}">Change Password</a>
                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                </ul>
            </div>
            <div class="col-md-2"></div>
            
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change Password</h3>

                    <div>
                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                                <input id="current_password" name="oldpassword" type="password" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password <span>*</span></label>
                                <input id="password" name="password" type="password" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Update"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection