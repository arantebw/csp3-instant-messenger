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
        @foreach ($user as $u1) <strong>{{ '@' . $u1->username }}</strong> @endforeach
        <span class="counter-padding">&middot;</span>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
    </p>

    <small class="text-muted">in #general</small>

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
