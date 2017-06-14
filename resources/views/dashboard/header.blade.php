<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
        <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Redirect members to reoslack landing page -->
    <a class="navbar-brand" href="/dashboard">
        <i class="fa fa-registered" aria-hidden="true"></i>
        reoslack
    </a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/{{ session('current_team') }}/{{ session('current_channel') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
        </ul>
    </div>
</nav>
