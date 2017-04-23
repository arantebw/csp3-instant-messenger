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

    <p>
        @foreach ($users as $user)
            @if ($message->member_id === $user->id)
                <strong>{{ '@' . $user->username }}</strong>
            @endif
        @endforeach
        <span class="counter-padding">&middot;</span>
        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
    </p>

    <small class="text-muted">in #general</small>

    <p class="group-message">{{ $message->body }}</p>

    <div class="inline-form">
        <a class="btn btn-outline-primary" href="/dashboard/{{ session('current_team') }}/{{ session('current_channel') }}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Back
        </a>
    </div>

    <div class="inline-form pull-right">
        <a class="btn btn-outline-primary" href="/message/{{ $message->id }}/edit">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            Edit
        </a>

        <form class="inline-form" method="POST" action="/message/{{ $message->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-outline-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                Delete
            </button>
        </form>
    </div>
    <hr>

    <!-- Show number of comments -->

    <!-- Show comments thread -->
    <div class="form-group">
        @foreach ($message->comments as $comment)
        @include ('dashboard.message_comments')
        @endforeach
    </div>

    @include ('dashboard.create_comment')
</main>
@endsection
