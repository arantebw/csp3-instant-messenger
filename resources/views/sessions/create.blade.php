@extends ('teams.create')

@section ('title')
    reoslack &middot; Sign in
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
        <h3 class="card-header text-center">Sign in</h3>

        <div class="card-block">
            <p class="card-text text-muted">Please enter your email address and password.</p>
            <br>

            <form class="form-group" action="/signin" method="POST">
                {{ csrf_field() }}

                <label for="email_address">Email address</label>
                <input class="form-control form-control-lg" type="email" placeholder="juan.dela.cruz@example.com" id="email_address" name="email_address" required>
                <br>

                <label for="password">Password</label>
                <input class="form-control form-control-lg" type="password" placeholder="Password" id="password" name="password" required>
                <br>

                <div class="pull-left">
                    <a href="/members/create" class="btn btn-outline-primary btn-lg">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        Sign up
                    </a>
                </div>
                <div class="pull-right">
                    <button class="btn btn-success btn-lg" type="submit">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        Create or join a team
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
