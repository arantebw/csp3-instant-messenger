@extends ('layouts.master')

@section ('header')
	@include ('dashboard.header')
@endsection

@section ('sidebar')
	@include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
    <p>username <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span></p>
    <p class="text-muted">in #general</p>
    <p>{{ $message->body }}</p>
    <!-- Show number of comments -->

    <!-- Show comments thread -->
    @foreach ($message->comments as $comment)
    <div class="list-group">
        <p class="list-group-item">username <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span></p>
    	<a href="#" class="list-group-item">{{ $comment->body }}</a>
    </div>
    <br>
    @endforeach

    @include ('dashboard.create_comment')
</main>
@endsection