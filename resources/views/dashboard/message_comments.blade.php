<div>
    <p>
		@foreach ($users as $user)
			@if ($comment->member_id === $user->id)
				{{ '@' . $user->username }}
			@endif
		@endforeach
    	<span class="counter-padding">&middot;</span>
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
    </p>

	<a href="/comment/{{ $comment->id }}">
        <p class="group-message">
            {{ $comment->body }}
        </p>
    </a>
</div>
<hr>
