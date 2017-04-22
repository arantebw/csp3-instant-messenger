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

    <div class="">
        <div>
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
        <hr>

        <div class="pull-right">
            <a class="btn btn-outline-primary" href="/dashboard/{{ session('current_team') }}/{{ $direct_message->sender_id }}/chats/{{ $direct_message->receiver_id }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </a>

            <a class="btn btn-outline-primary" href="/direct-messages/{{ $direct_message->id }}/edit">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                Edit
            </a>

            <form class="inline-form"action="" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="button" class="btn btn-outline-danger">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    Delete
                </button>
            </form>

        </div>
    </div>
</main>
@endsection
