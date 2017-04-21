@extends ('layouts.master')

@section ('title')
    reoslack &middot; Direct messages
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
            @foreach ($user2 as $u2)
                    <strong>{{ '@' . $u2->username }}</strong>
                @if ($u2->id === Auth::user()->id)
                    <span class="text-muted">(you)</span>
                @endif
            @endforeach
        </p>
        <hr>

        <!-- Show direct message threads -->
        <!-- Show message maker -->
    </main>
@endsection
