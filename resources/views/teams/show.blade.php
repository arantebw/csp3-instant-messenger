@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Manage your team
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
        <h3 class="card-header text-center">Manage your team</h3>

        <!-- <img class="card-img-top" src="/img/team.jpg"> -->

        <form class="card-block" method="POST" action="/teams/{{ $team->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}

            <div class="form-group">
                <label for="team_name">Name</label>
                <input class="form-control form-control-lg" type="text" value="{{ $team->name }}" id="team_name" name="team_name" disabled>
                <br>

                <label for="team_owner">Owner</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $user->first_name . ' ' . $user->last_name }}" id="team_owner" name="team_owner" disabled>
                <br>

                <div class="form-group pull-right">
                    <a class="btn btn-outline-primary btn-lg" href="/teams/{{ $team->id }}/set">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        Set as current team
                    </a>

                    <a class="btn btn-outline-primary btn-lg" href="/teams/{{ $team->id }}/edit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        Edit
                    </a>

                    <button class="btn btn-outline-danger btn-lg" type="submit">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Delete
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div id="card-settings" class="card">
        <div class="card-header text-center">
            <h4>Team members</h4>
        </div>

        <div class="card-block">
            <ul class="list-group list-group-flush">
                @foreach ($team_members as $member)
                    <li class="list-group-item">
                        {{ $member->first_name . ' ' . $member->last_name }}
                        @if ($user->id == $member->id)
                            <small class="text-muted channel-owner">(owner)</small>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
