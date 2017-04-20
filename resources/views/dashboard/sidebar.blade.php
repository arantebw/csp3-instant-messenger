<!-- dashboard/sidebar.blade.php -->
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            @if (Auth::check())
                <a class="nav-link" href="/members/{{ Auth::user()->id }}">
                    <!-- Displays user's first name and last name -->
                    <p>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                    </p>

                    <!-- Displays username and team user currently in -->
                    <p>
                        <i class="fa fa-at" aria-hidden="true"></i>
                        {{ Auth::user()->username }}
                    </p>

                    <p>
                        <i class="fa fa-users" aria-hidden="true"></i>
                        {{ session('current_team') }}
                    </p>
                </a>
            @else
                <!-- No authorized user is logged in -->
                <a class="nav-link" href="#">
                    <p>Billy Wilson Arante</p>
                    <p>arante</p>
                    <p>team-7</p>
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
            <a class="nav-link" href="/teams/{{ $team->id }}">
                <i class="fa fa-users" aria-hidden="true"></i>
                {{ $team->name }}
            </a>
        </li>
        @endforeach
    </ul>
    <hr>

    <!-- Show team's created channels -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Channels</a>
        </li>

        @foreach ($channels as $channel)
        <li class="nav-item">
            <a class="nav-link" href="/channels/{{ $channel->id }}">
                <i class="fa fa-slack" aria-hidden="true"></i>
                {{ $channel->name }}
            </a>
        </li>
        @endforeach
    </ul>
    <hr>

    <!-- Shows available direct messages for team members -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Direct Messages</a>
        </li>

        @foreach ($users as $user)
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/{{ session('current_team') }}/{{ Auth::user()->username }}/chats/{{ $user->username }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                {{ $user->first_name . ' ' . $user->last_name }}
            </a>
        </li>
        @endforeach
    </ul>
    <hr>

    <!-- Creates new team, channel, or invite member -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Actions</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/teams/create">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Create team
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/teams/join">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Join team
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/channels/create">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Create channel
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Join channel
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Invite member
            </a>
        </li>
    </ul>
</nav>
