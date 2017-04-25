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

    <div class="">
        <div>
            <i class="fa fa-user-circle-o fa-3x text-muted" aria-hidden="true"></i>
            
            <strong>{{ '@' . $sender->username }}</strong>

            <span class="counter-padding">&middot;</span>

            <small class="text-muted">{{ $direct_message->created_at->diffForHumans() }}</small>

            <div class="text-muted">
                <small>for <strong>{{ $receiver->username }}</strong></small>
            </div>
        </div>

        <form action="/direct-messages/{{ $direct_message->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <textarea id="body" name="body" class="edit-textarea">{{ $direct_message->body }}</textarea>

            <div class="form-group padding-10px">
                <div class="pull-right">
                    <button type="submit" class="btn btn-outline-success">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save
                    </button>

                    <a class="btn btn-outline-primary" href="/direct-messages/{{ $direct_message->id }}">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
