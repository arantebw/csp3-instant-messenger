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
        @include ('layouts.errors')
        @include ('layouts.danger')
        @include ('layouts.info')
        
        <p>
            @foreach ($user2 as $u2)
                <i class="fa fa-user-circle-o fa-3x text-muted" aria-hidden="true"></i>

                <strong>{{ '@' . $u2->username }}</strong>

                @if ($u2->id === Auth::user()->id)
                    <span class="text-muted">(you)</span>
                @endif

                <span class="counter-padding">&middot;</span>

                <!-- Show status of user (i.e., online or offline) -->
                <small>
                    @if ($u2->online)
                        <i class="fa fa-circle" aria-hidden="true" style="color:lightgreen;"></i>
                        online
                    @else
                        <i class="fa fa-circle-o" aria-hidden="true"></i>
                        offline
                    @endif
                </small>
            @endforeach
        </p>
        <hr>

        <!-- Show direct message threads -->
        @include ('members.show_direct_message')

        <!-- Show message maker -->
        @include ('members.direct_message_maker')
    </main>
@endsection
