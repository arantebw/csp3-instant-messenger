<div>
    @foreach ($direct_messages as $direct_message)
    <div>
        @foreach ($users as $user)
            @if ($user->id === $direct_message->sender_id)
                {{ $user->username }}
            @endif
        @endforeach

    	&middot;
    	<small class="text-muted">
            {{ $direct_message->created_at->diffForHumans() }}
        </small>
    </div>

    <a href="/direct-message/{{ $direct_message->id }}">
        <p class="group-message">{{ $direct_message->body }}</p>
    </a>

    <hr>
    @endforeach
</div>
