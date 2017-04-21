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
                @foreach ($user as $u1)
                    @if ($u1->id == $team->owner)
                        <input class="form-control form-control-lg" type="text" value="{{ $u1->first_name . ' ' . $u1->last_name }}" id="team_owner" name="team_owner" disabled>
                    @endif
                @endforeach
                <br>

                <button class="btn btn-outline-primary btn-lg pull-right left-margin" type="submit">
                    Delete
                </button>

                <a class="btn btn-outline-primary btn-lg pull-right left-margin" href="/teams/{{ $team->id }}/edit">
                    Edit
                </a>

                <a class="btn btn-outline-primary btn-lg pull-right left-margin" href="/teams/{{ $team->id }}/set">
                    Set as current team
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
