@extends ('layouts.master')

@section('title')
    reoslack &middot; Modify group message
@endsection

@section ('header')
    @include ('dashboard.header')
@endsection

@section ('sidebar')
    @include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <p>
            <i class="fa fa-user-circle-o fa-3x text-muted" aria-hidden="true"></i>

            @foreach ($user as $u1) <strong>{{ '@' . $u1->username }}</strong> @endforeach

            <span class="counter-padding">&middot;</span>

            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
        </p>

        <small class="text-muted">{{ 'in #' . $message->channel['name'] }}</small>

    <form method="POST" action="/message/{{ $message->id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <textarea class="edit-textarea" id="body" name="body">{{ $message->body }}</textarea>

        <div class="inline-form pull-right padding-10px">

            <button class="btn btn-outline-success" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                Save
            </button>

            <a class="btn btn-outline-primary" href="/message/{{ $message->id }}">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Cancel
            </a>
        </div>
    </form>
</main>
@endsection
