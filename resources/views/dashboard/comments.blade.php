@extends ('layouts.master')

@section ('header')
	@include ('dashboard.header')
@endsection

@section ('sidebar')
	@include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
    <p>
        @foreach ($users as $user)
            @if ($message->member_id === $user->id)
                {{ $user->username }}
            @endif
        @endforeach
        &middot;
        <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>
    </p>

    <p class="text-muted">in #general</p>

    <p>{{ $message->body }}</p>
    <hr>

    <a class="btn btn-link" href="/message/{{ $message->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        Edit
    </a>
    &middot;
    <form class="inline-form" method="POST" action="/message/{{ $message->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" class="btn btn-link text-primary">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            Delete
        </button>
    </form>
    <hr>
    <!-- Show number of comments -->

    <!-- Show comments thread -->
    @foreach ($message->comments as $comment)
        @include ('dashboard.message_comments')
    @endforeach

    @include ('dashboard.create_comment')
</main>
@endsection
