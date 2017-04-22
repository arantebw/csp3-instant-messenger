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

        <div class="card">
            <h3 class="card-header text-center">Manage your channel</h3>

            <form class="card-block" method="POST" action="/channels/{{ $channel->id }}">
                {{ csrf_field() }}
                {{ method_field('PUT')}}

                <div class="form-group">
                    <label for="channel_name">Name</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $channel->name }}" id="channel_name" name="channel_name">
                    <br>

                    <label for="channel_purpose">Purpose of this channel</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $channel->purpose }}" id="channel_purpose" name="channel_purpose">
                    <br>

                    <label for="team_owner">Assign new owner of this channel?</label>
                    <select class="form-control form-control-lg" name="channel_owner">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @endforeach
                    </select>
                    <br>

                    <a class="btn btn-outline-primary btn-lg pull-right left-margin" href="/channels/{{ $channel->id }}">
                        Cancel
                    </a>

                    <button class="btn btn-outline-primary btn-lg pull-right left-margin" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
