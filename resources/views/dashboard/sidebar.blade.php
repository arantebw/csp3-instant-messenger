<!-- dashboard/sidebar.blade.php -->
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            @if (Auth::check())
                <a class="nav-link" href="/members/{{ Auth::user()->id }}">
                    <!-- Displays user's first name and last name -->
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}<br>

                    <!-- Displays username and team user currently in -->
                    {{ '@' . Auth::user()->username }}<br>
                    {{ session('team') }}
                </a>
            @else
                <!-- No authorized user is logged in -->
                <a class="nav-link" href="#">
                    Billy Wilson Arante<br>
                    @arante<br>
                    team-7
                </a>
            @endif
        </li>
    </ul>
    <hr>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Teams</a>
        </li>

        @foreach ($teams as $team)
        <li class="nav-item">
            <a class="nav-link" href="/teams/{{ $team->id }}">{{ $team->name }}</a>
        </li>
        @endforeach
    </ul>
    <hr>

    <!-- Show team's created channels -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Channels</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/dashboard">#general</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">#random</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">#daily-task</a>
        </li>
    </ul>
    <hr>

    <!-- Shows available direct messages for team members -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Direct Messages</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Kevin Durant</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Kyrie Irving</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Steph Curry</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">James Harden</a>
        </li>
    </ul>
    <hr>

    <!-- Creates new team, channel, or invite member -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="/teams/create">+ New team</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">+ New channel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">+ New member</a>
        </li>
    </ul>
</nav>
