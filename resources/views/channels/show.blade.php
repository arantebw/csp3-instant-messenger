@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Manage your channel
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

        @if (session('danger'))
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <span>{{ session('danger') }}</span>
        </div>
        @endif

        <div class="card">
            <h3 class="card-header text-center">Manage your channel</h3>

            <form class="card-block" method="POST" action="/channels/{{ $channel->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}

                <div class="form-group">
                    <label for="channel_name">Name</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $channel->name }}" id="channel_name" name="channel_name" disabled>
                    <br>

                    <label for="channel_purpose">Purpose of this channel</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $channel->purpose }}" id="channel_purpose" name="channel_purpose" disabled>
                    <br>

                    <label for="team_owner">Owner</label>
                        <input class="form-control form-control-lg" type="text" value="{{ $user->first_name . ' ' . $user->last_name }}" id="channel_owner" name="channel_owner" disabled>
                    <br>

                    <button class="btn btn-outline-danger btn-lg pull-right left-margin" type="submit">
                        Delete
                    </button>

                    <a class="btn btn-outline-primary btn-lg pull-right left-margin" href="/channels/{{ $channel->id }}/edit">
                        Edit
                    </a>

                    <a class="btn btn-outline-primary btn-lg pull-right left-margin" href="/channels/{{ $channel->id }}/set">
                        Set as current channel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
