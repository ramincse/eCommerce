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
                    <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Welcome to Easy Online Shop</h3>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection
