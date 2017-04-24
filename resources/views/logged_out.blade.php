@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Thank you for using Reoslack!
@endsection

@section ('header')
<div class="container-fluid main-header indigo-header">
    @include ('layouts.header_content')
</div>
@endsection

@section ('content')
    <div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
        @include ('layouts.errors')
        @include ('layouts.danger')
        @include ('layouts.info')

        <div class="card">
            <h3 class="card-header text-center">Thank you for using Reoslack!</h3>

            <div class="card-block">
                <div class="text-center">
                    <h1 class="card-text text-muted"><strong><em>Reoslack, the messenger of awesome web developers.</em></strong></h1>
                </div>
            </div>

            <div class="card-block">
                <div class="text-center">
                    <a href="/signin" class="btn btn-success btn-sm">Sign in</a>
                    <a href="/members/create" class="btn btn-outline-primary btn-sm">Sign up</a>
                    <a href="/teams/create" class="btn btn-outline-primary btn-sm">Create a team</a>
                    <a href="/join" class="btn btn-outline-primary btn-sm">Join a team</a>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection
