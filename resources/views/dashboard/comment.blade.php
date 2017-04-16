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
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
    </p>
    
    <p class="text-muted">in #general</p>
    
    <p>{{ $comment->body }}</p>

    <a href="#">Edit</a> &middot; <a href="#">Delete</a>
</main>
@endsection