<div>
    <p>
        <i class="fa fa-user-circle-o fa-2x text-muted" aria-hidden="true"></i>

		@foreach ($users as $user)
			@if ($comment->member_id === $user->id)
				<strong>{{ $user->username }}</strong>
			@endif
		@endforeach

    	<span class="counter-padding">&middot;</span>
        
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
    </p>

	<a href="/comment/{{ $comment->id }}">
        <p class="group-message">
            {{ $comment->body }}
        </p>
    </a>
</div>
