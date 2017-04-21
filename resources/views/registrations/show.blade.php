@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; User profile
@endsection

@section ('header')
<div class="container-fluid main-header yellow-header">
    @include ('layouts.header_content')
</div>
@endsection

@section ('content')
<a href="/dashboard">
    <i class="fa fa-times fa-3x close-button-black text-muted" aria-hidden="true"></i>
</a>

<div class="col-md-8 col-md-offset-4 card-settings">
    @include ('layouts.errors')

    <div class="card">
        <h3 class="card-header text-center">Your user profile</h3>

        <div class="card-block">
            <div class="container">
                <div class="form-group row">
                    <label for="">First name</label>

                    <input class="form-control form-control-lg" type="text" name="" value="{{  Auth::user()->first_name }}" disabled>
                </div>

                <div class="form-group row">
                    <label for="">Last name</label>

                    <input class="form-control form-control-lg" type="text" name="" value="{{  Auth::user()->last_name }}" disabled>
                </div>

                <div class="form-group row">
                    <label for="">Email address</label>

                    <input class="form-control form-control-lg" type="text" name="" value="{{  Auth::user()->email }}" disabled>
                </div>

                <div class="form-group row">
                    <label for="">Username</label>

                    <input class="form-control form-control-lg" type="text" name="" value="{{  Auth::user()->username }}" disabled>
                </div>

                <div class="form-group row">
                    <label for="">Password</label>

                    <input class="form-control form-control-lg" type="password" name="" value="{{  Auth::user()->password }}" disabled>
                </div>

                <div class="form-group row pull-right">
                    <a class="btn btn-outline-primary btn-lg left-margin" href="/members/{{ Auth::user()->id }}/edit">Edit</a>

                    <form class="" action="/members/{{ Auth::user()->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-outline-primary btn-lg left-margin" type="submit" name="button">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
