@extends ('teams.create')

@section ('title')
    reoslack &middot; Sign up
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
        <h3 class="card-header text-center">What's your name?</h3>

        <div class="card-block">
            <p class="card-text text-muted">Your name will be displayed along with your messages in reoslack.</p>
            <br>

            <form class="form-group" action="/members" method="POST">
                {{ csrf_field() }}

                <label for="name_group">Your name</label>
                <div id="name_group" class="form-group container">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control form-control-lg" type="text" placeholder="First name" id="first_name" name="first_name" required>
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-lg" type="text" placeholder="Last name" id="last_name" name="last_name" required>
                        </div>
                    </div>
                </div>
                <br>

                <label for="email_address">Email address</label>
                <input class="form-control form-control-lg" type="text" placeholder="juan.dela.cruz@example.com" id="email_address" name="email_address" required>
                <br>

                <label for="username">Username</label>
                <input class="form-control form-control-lg" type="text" placeholder="juan.dela.cruz" id="username" name="username" required>
                <p class="text-muted">Please choose a username that is all lowercase, containing only letters, numbers, periods, hyphens, and underscores.</p>
                <br>


                <label for="password_group">Password</label>
                <div id="password_group" class="form-group container">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control form-control-lg" type="password" placeholder="Password" id="password" name="password" required>
                            <!-- <br> -->
                        </div>
                        <div class="col-md-6">
                            <input class="form-control form-control-lg" type="password" placeholder="Confirm password" id="password_confirmation" name="password_confirmation" required>
                            <!-- <br> -->
                        </div>
                    </div>
                </div>
                <br>

                <button class="btn btn-success btn-lg pull-right" type="submit">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Continue
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
