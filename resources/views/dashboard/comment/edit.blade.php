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

    <form method="POST" action="/comment/{{ $comment->id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <textarea id="body" name="body">{{ $comment->body }}</textarea>

        <hr>
        <button class="btn btn-link"type="submit">Save</button>
        &middot;
        <a class="btn btn-link" href="/comment/{{ $comment->id }}">Cancel</a>
    </form>
</main>
@endsection
