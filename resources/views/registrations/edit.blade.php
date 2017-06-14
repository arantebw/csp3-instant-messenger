@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Edit your profile
@endsection

@section ('header')
<div class="container-fluid main-header indigo-header">
    @include ('layouts.header_content')
</div>
@endsection

@section ('content')
<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    @include ('layouts.errors')

    <div class="card">
        <h3 class="card-header text-center">Edit your profile</h3>

        <div class="card-block text-center">
            <img class="profile-img" src="{{ $default_img }}">
        </div>

        <div class="card-block">
            <form class="container" method="post" action="/members/{{ Auth::user()->id }}">
                {{ csrf_field() }}
                {{ method_field('PUT')}}

                <div class="form-group row">
                    <label for="">First name</label>
                    <input class="form-control form-control-lg" type="text" name="first_name" value="{{  Auth::user()->first_name }}">
                </div>
                <div class="form-group row">
                    <label for="">Last name</label>
                    <input class="form-control form-control-lg" type="text" name="last_name" value="{{  Auth::user()->last_name }}">
                </div>
                <div class="form-group row">
                    <label for="">Email address</label>
                    <input class="form-control form-control-lg" type="text" name="email_address" value="{{  Auth::user()->email }}">
                </div>
                <div class="form-group row">
                    <label for="">Username</label>
                    <input class="form-control form-control-lg" type="text" name="username" value="{{  Auth::user()->username }}">
                </div>
                <div class="form-group row">
                    <label for="">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" value="{{  Auth::user()->password }}">
                </div>
                <div class="form-group row">
                    <label for="">Confirm password</label>
                    <input class="form-control form-control-lg" type="password" name="password_confirmation" value="{{  Auth::user()->password }}">
                </div>
                <div class="form-group pull-right padding-10px">
                    <button class="btn btn-outline-success btn-lg" type="submit" name="button">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save
                    </button>
                    <a class="btn btn-outline-primary btn-lg" href="/members/{{ Auth::user()->id }}">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
