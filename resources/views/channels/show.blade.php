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
        @include ('layouts.danger')
        @include ('layouts.info')

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

                    <div class="form-group pull-right">
                        <a class="btn btn-outline-primary btn-lg" href="/channels/{{ $channel->id }}/set">
                            <i class="fa fa-slack" aria-hidden="true"></i>
                            Set as current channel
                        </a>

                        <a class="btn btn-outline-primary btn-lg" href="/channels/{{ $channel->id }}/edit">
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

        <div class="card" style="margin-top:70px;">
            <div class="card-header text-center">
                <h4>Channel members</h4>
            </div>

            <div class="card-block">
                <ul class="list-group list-group-flush">
                    @foreach ($channel_members as $member)
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
