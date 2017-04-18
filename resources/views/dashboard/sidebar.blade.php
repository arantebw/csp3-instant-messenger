<!-- dashboard/sidebar.blade.php -->
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            @if (Auth::check())
                <a class="nav-link" href="/members/{{ Auth::user()->id }}">
                    <!-- Displays user's first name and last name -->
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                    <br>
                    <!-- Displays username and team user currently in -->
                    {{ '@' . Auth::user()->username }} in {{ session('team') }}
                </a>
            @else
                <!-- No authorized user is logged in -->
                <a class="nav-link" href="#">
                    Billy Wilson Arante
                    <br>
                    @arante in team-7
                </a>
            @endif
        </li>
    </ul>
    <hr>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Teams</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">wits-inc</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">fccmanila</a>
        </li>
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
            <a class="nav-link" href="#">Regine Blanco</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Wo Harmon Scheiz</a>
        </li>
    </ul>
    <hr>

    <!-- Creates new team, channel, or invite member -->
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#">+ New team</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">+ New channel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">+ New member</a>
        </li>
    </ul>
</nav>
