@extends ('layouts.master')

@section ('header')
	@include ('dashboard.header')
@endsection

@section ('sidebar')
	@include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
    <p>username &middot;
        <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>
    </p>

    <p class="text-muted">in #general</p>

    <p>{{ $message->body }}</p>

    <hr>
    <a class="btn btn-link" href="/message/{{ $message->id }}/edit">Edit</a>
    &middot;
    <a class="btn btn-link" href="#">Delete</a>
    <hr>
    <!-- Show number of comments -->

    <!-- Show comments thread -->
    @foreach ($message->comments as $comment)
        @include ('dashboard.message_comments')
    @endforeach

    @include ('dashboard.create_comment')
</main>
@endsection
