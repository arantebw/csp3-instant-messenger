<!-- dashboard/index.blade.php -->
@extends ('layouts.master')

@section ('title')
    reoslack &middot; Dashboard
@endsection

@section ('header')
    @include ('dashboard.header')
@endsection

@section ('sidebar')
    @include ('dashboard.sidebar')
@endsection

@section ('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 section-right">
    @include ('layouts.errors')
    @include ('layouts.danger')
    @include ('layouts.info')

    <!-- <h2>{{ '#' . session('current_channel') }}</h2> -->
    <h2>{{ '#' . $current_channel->name }}</h2>
    <small class="text-muted">
        <!-- Display team/channel members counter -->
        <span>
            <a href="#" class="text-muted counter-icons">
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </a>

            <span class="counter-padding">&middot;</span>

            <a href="#" class="text-muted counter-icons">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                @if (Auth::check())
                    {{ count($current_channel->channel_members) }}
                @endif
            </a>
        </span>

        <span class="counter-padding">&middot;</span>

        <!-- Display purpose of channel -->
        <span>
            {{ session('current_channel_purpose') }}
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
