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
        @foreach ($users as $user) {{ '@' . $user->username }} @endforeach
        &middot;
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
    </p>

    <p class="text-muted">in #general</p>

    <p class="group-message">{{ $comment->body }}</p>

    <hr>
    <a class="btn btn-link" href="/comment/{{ $comment->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        Edit
    </a>
    &middot;
    <form class="inline-form" method="POST" action="/comment/{{ $comment->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" class="btn btn-link">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            Delete
        </button>
    </form>
    <hr>
</main>
@endsection
