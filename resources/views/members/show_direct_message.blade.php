<div class="direct-messages">
    @foreach ($direct_messages as $direct_message)
    <div>
        <i class="fa fa-user-circle-o fa-2x text-muted" aria-hidden="true"></i>

        @foreach ($users as $user)
            @if ($user->id === $direct_message->sender_id)
                <strong>{{ $user->username }}</strong>
            @endif
        @endforeach

    	<span class="counter-padding">&middot;</span>

    	<small class="text-muted">
            {{ $direct_message->created_at->diffForHumans() }}
        </small>
    </div>

    <a href="/direct-messages/{{ $direct_message->id }}">
        <p class="group-message">{{ $direct_message->body }}</p>
    </a>

    @endforeach
</div>
