@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Your user profile
@endsection

@section ('header')
<div class="container-fluid main-header indigo-header">
    @include ('layouts.header_content')
</div>
@endsection

@section ('content')
<a href="/dashboard">
    <i class="fa fa-times fa-3x close-button-white" aria-hidden="true"></i>
</a>

<div class="col-md-8 col-md-offset-4 card-settings">
    @include ('layouts.errors')
    @include ('layouts.danger')
    @include ('layouts.info')

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

                <div class="form-group pull-right">
                    <a class="btn btn-outline-primary btn-lg" href="/members/{{ Auth::user()->id }}/logout">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        Sign out
                    </a>

                    <a class="btn btn-outline-primary btn-lg" href="/members/{{ Auth::user()->id }}/edit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        Edit
                    </a>

                    <form class="inline-form" action="/members/{{ Auth::user()->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-outline-danger btn-lg" type="submit" name="button">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
