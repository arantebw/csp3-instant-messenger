@extends('layouts.master_alternative')

@section('title')
    reoslack &middot; Join a team
@endsection

@section('header')
<div class="container-fluid main-header indigo-header">
    @include ('layouts.header_content')
</div>
@endsection

@section('content')
<a href="/dashboard">
    <i class="fa fa-times fa-3x close-button-white" aria-hidden="true"></i>
</a>

<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    @include ('layouts.errors')

    <div class="card">
        <h3 class="card-header text-center">Join a team</h3>

        <div class="card-block">
            <h4 class="card-title">Enter existing team's name, or create a new one</h4>

            <p class="card-text text-muted">Please enter your team's name in all lowercase letters separated by dashes.</p>

            <form class="form-group" action="/join" method="POST">
                {{ csrf_field() }}

                <input class="form-control form-control-lg" type="text" placeholder="your-new-team" id="team" name="team" required>
                <br>

                <a class="btn btn-outline-primary btn-lg" href="/teams/create">
                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                    Create a team
                </a>

                <button class="btn btn-success btn-lg pull-right" type="submit">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Continue
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
