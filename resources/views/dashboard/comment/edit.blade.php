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
            @foreach ($user as $u1) <strong>{{ '@' . $u1->username }}</strong> @endforeach
            <span class="counter-padding">&middot;</span>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        </p>

        <small class="text-muted">in #general</small>

    <form method="POST" action="/comment/{{ $comment->id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <textarea class="edit-textarea" id="body" name="body">{{ $comment->body }}</textarea>

        <div class="inline-form pull-right padding-10px">
            <button class="btn btn-outline-success"type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                Save
            </button>

            <a class="btn btn-outline-primary" href="/comment/{{ $comment->id }}">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Cancel
            </a>
        </div>
    </form>
</main>
@endsection
