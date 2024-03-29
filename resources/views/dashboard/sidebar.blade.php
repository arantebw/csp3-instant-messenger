<!-- dashboard/sidebar.blade.php -->
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            @if (Auth::check())
                <a class="nav-link side-link text-muted" href="/members/{{ Auth::user()->id }}">
                    <!-- Displays user's first name and last name -->
                    <p>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="sidebar-item">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                        </span>
                    </p>
                    <hr>

                    <!-- Displays username and team user currently in -->
                    <p>
                        <i class="fa fa-at" aria-hidden="true"></i>
                        <span class="sidebar-item">
                            {{ Auth::user()->username }}
                        </span>
                    </p>

                    <p>
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="sidebar-item">
                            @if (session('current_team'))
                                {{ session('current_team') }}
                            @else
                                Choose your current team
                            @endif
                        </span>
                    </p>
                </a>
            @else
                <!-- No authorized user is logged in -->
                <!-- Displays user's first name and last name -->
                <a class="nav-link side-link text-muted" href="#">
                <p>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="sidebar-item">
                        First Name Last Name
                    </span>
                </p>
                <hr>

                <!-- Displays username and team user currently in -->
                <p>
                    <i class="fa fa-at" aria-hidden="true"></i>
                    <span class="sidebar-item">
                        username
                    </span>
                </p>

                <p>
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="sidebar-item">
                        current-team
                    </span>
                </p>
            </a>
            @endif
        </li>
    </ul>
    <hr>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">
                Teams
            </a>
        </li>

        @if (Auth::check())
            @foreach ($teams as $team)
                <li class="nav-item">
                    <a class="nav-link side-link text-muted" href="/teams/{{ $team->id }}">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="sidebar-item">
                                {{ $team->name }}
                        </span>
                        <small class="pull-right">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            {{  count($team->team_members) }}
                        </small>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    <hr>

    <!-- Show team's created channels -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">
                Channels
            </a>
        </li>

        @if (Auth::check())
            @foreach ($channels as $channel)
            @foreach ($my_channels as $my_channel)
            @if ($channel->id == $my_channel->channel_id)
                <li class="nav-item">
                    <a class="nav-link side-link text-muted" href="/channels/{{ $channel->id }}">
                        <i class="fa fa-slack" aria-hidden="true"></i>
                        <span class="sidebar-item">
                            {{ $channel->name }}
                        </span>
                        <small class="pull-right">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            {{ count($channel->channel_members) }}
                        </small>
                    </a>
                </li>
            @endif
            @endforeach
            @endforeach
        @endif
    </ul>
    <hr>

    <!-- Shows available direct messages for team members -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">
                Direct Messages
                <small class="pull-right">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    {{ count($users)}}
                </small>
            </a>
        </li>

        @if (Auth::check())
            @foreach ($users as $user)
                <li class="nav-item">
                    <a class="nav-link side-link text-muted" href="/dashboard/{{ session('current_team') }}/{{ Auth::user()->id }}/chats/{{ $user->id }}">
                        <!-- Display user status -->
                        @if ($user->online)
                            <i class="fa fa-circle" aria-hidden="true" style="color:lightgreen;"></i>
                        @else
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                        @endif

                        <span class="sidebar-item">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    <hr>

    <!-- Creates new team, channel, or invite member -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Actions</a>
        </li>

        <li class="nav-item">
            <a class="nav-link side-link text-muted" href="/teams/create">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span class="sidebar-item">
                    Create team
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link side-link text-muted" href="/join">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span class="sidebar-item">
                    Join team
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link side-link text-muted" href="/channels/create">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span class="sidebar-item">
                    Create channel
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link side-link text-muted" href="/join/channel">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span class="sidebar-item">
                    Join channel
                </span>
            </a>
        </li>
    </ul>
</nav>
