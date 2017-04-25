@extends ('layouts.master')

@section ('header')
	@include ('dashboard.header')
@endsection

@section ('sidebar')
	@include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
    @include ('layouts.errors')
    @include ('layouts.danger')
    @include ('layouts.info')

    <div>
        <i class="fa fa-user-circle-o fa-3x text-muted" aria-hidden="true"></i>

        <strong>{{ '@' . $sender->username }}</strong>

        <span class="counter-padding">&middot;</span>

        <small class="text-muted">{{ $direct_message->created_at->diffForHumans() }}</small>

        <div class="text-muted">
            <small>for <strong>{{ $receiver->username }}</strong></small>
        </div>
    </div>

    <div class="group-message">
        <p>{{ $direct_message->body }}</p>
    </div>

    <div class="form-group padding-10px">
        <div class="d-inline-block">
            <a class="btn btn-outline-primary" href="/dashboard/{{ session('current_team') }}/{{ $direct_message->sender_id }}/chats/{{ $direct_message->receiver_id }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </a>

        </div>
        <div class="d-inline-block pull-right">
            <form class="inline-form" action="/direct-messages/{{ $direct_message->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <a class="btn btn-outline-primary" href="/direct-messages/{{ $direct_message->id }}/edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Edit
                </a>

                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
