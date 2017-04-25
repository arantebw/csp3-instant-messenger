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
        <i class="fa fa-user-circle-o fa-3x text-muted" aria-hidden="true"></i>

        @foreach ($user as $u1) <strong>{{ '@' . $u1->username }}</strong> @endforeach
        
        <span class="counter-padding">&middot;</span>
        
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
    </p>

    <small class="text-muted">in #general</small>

    <p class="group-message">{{ $comment->body }}</p>

    <div class="inline-form pull-left padding-10px">
        <a class="btn btn-outline-primary" href="/message/{{ $comment->group_message_id }}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Back
        </a>
    </div>

    <div class="inline-form pull-right padding-10px">
        <a class="btn btn-outline-primary" href="/comment/{{ $comment->id }}/edit">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            Edit
        </a>

        <form class="inline-form" method="POST" action="/comment/{{ $comment->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-outline-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                Delete
            </button>
        </form>
    </div>
</main>
@endsection
