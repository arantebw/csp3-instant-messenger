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
<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    @include ('layouts.errors')

    <form class="card" method="POST" action="/teams/{{ $team->id }}">
        {{ csrf_field() }}
        {{ method_field('PUT')}}

        <h3 class="card-header text-center">Manage your team</h3>

        <div class="card-block">
            <div class="form-group">
                <label for="team_name">Change the name of your team?</label>
                <input class="form-control form-control-lg" type="text" value="{{ $team->name }}" id="team_name" name="team_name">
                <br>

                <label for="team_owner">Assign new owner of this team?</label>
                <select class="form-control form-control-lg" name="team_owner">
                    @foreach ($user as $u1)
                        <option value="{{ $u1->id }}">
                            {{ $u1->first_name . ' ' . $u1->last_name }}
                        </option>
                    @endforeach
                </select>
                <br>

                <div class="form-group pull-right">
                    <button class="btn btn-outline-success btn-lg" type="submit">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save
                    </button>

                    <a class="btn btn-outline-primary btn-lg" href="/teams/{{ $team->id }}">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
