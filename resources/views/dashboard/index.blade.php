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
