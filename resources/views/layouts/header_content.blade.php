<div class="container">
    <div class="row">
        <div class="col-sm-6">
        @if (!Auth::check())
            <a href="/" class="brand-name">
        @else
            <a href="/dashboard" class="brand-name">
        @endif
                <h1>
                    <i class="fa fa-registered" aria-hidden="true"></i>
                    reoslack
                </h1>
            </a>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</div>
