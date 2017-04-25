<div>
    <div>
        <!-- User image -->
        <i class="fa fa-user-circle-o fa-2x text-muted" aria-hidden="true"></i>

        <div class="d-inline align-middle" style="height:100%;">
            @foreach ($users as $user)
                @if ($message->member_id === $user->id)
                    <strong>{{ $user->username }}</strong>
                @endif
            @endforeach

            <span class="counter-padding">&middot;</span>

            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>

    <a href="/message/{{ $message->id }}">
        <p class="group-message">{{ $message->body }}</p>
    </a>
</div>
