<!-- dashboard/index.blade.php -->
@extends ('layouts.master')

@section ('header')
    @include ('dashboard.header')
@endsection

@section ('sidebar')
    @include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 section-right">
    <h2>{{ '#' . session('current_channel') }}</h2>  <!-- Current channel -->
    <small class="text-muted">
        <span>
            <a href="#">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                5
            </a>
        </span>
        <span class="counter-padding">&middot;</span>
        <span>
            What is your purpose?
        </span>
    </small>
    <hr>

    <!-- Shows group messages -->
    @foreach ($messages as $message)
        @include ('dashboard.group_messages')
    @endforeach
    <br><br><br>

    <!-- Adds new message to channel -->
    @include ('dashboard.create_message')
</main>
@endsection
