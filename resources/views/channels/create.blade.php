@extends ('teams.create')

@section ('title')
    reoslack &middot; Create new channel
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

<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    @include ('layouts.errors')
    @include ('layouts.danger')
    @include ('layouts.info')

    <div class="card">
        <h3 class="card-header text-center">Create your new channel</h3>

        <div class="card-block">
            <h4 class="card-title">Enter your new channel's name</h4>

            <p class="card-text">Please enter your channel's name in all lowercase letters separated by dashes.</p>

            <form class="form-group" action="/channels" method="post">
                {{ csrf_field() }}

                <input class="form-control form-control-lg" type="text" placeholder="your-new-channel" id="channel" name="channel" required>
                <br>

                <input class="form-control form-control-lg" type="text" placeholder="Purpose of this channel" id="purpose" name="purpose" required>
                <br>

                <div class="d-inline-block">
                    <a href="/join/channel" class="btn btn-outline-primary btn-lg">
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                        Join a channel
                    </a>
                </div>
                <button class="btn btn-success btn-lg pull-right" type="submit">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Continue
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
