@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Welcome to Reoslack!
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
            <h3 class="card-header text-center">Welcome to Reoslack!</h3>

            <div class="card-block">
                <div class="text-center">
                    <h1 class="card-text text-muted"><strong><em>Reoslack, the replication of slack.</em></strong></h1>
                </div>
            </div>

            <div class="card-block">
                <div class="text-center">
                    <a href="/signin" class="btn btn-success btn-lg">Sign in</a>
                    <a href="/members/create" class="btn btn-outline-primary btn-lg">Sign up</a>
                    <a href="/teams/create" class="btn btn-outline-primary btn-lg">Create a team</a>
                    <a href="/join" class="btn btn-outline-primary btn-lg">Join a team</a>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection
