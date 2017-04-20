<div>
    <p>
		@foreach ($users as $user)
			@if ($comment->member_id === $user->id)
				{{ $user->username }}
			@endif
		@endforeach
    	&middot;
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
    </p>

	<a href="/comment/{{ $comment->id }}">{{ $comment->body }}</a>
</div>
<hr>
