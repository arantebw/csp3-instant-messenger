<div>
    <div>
    	@foreach ($users as $user)
    		@if ($message->member_id === $user->id)
    			{{ '@' . $user->username }}
    		@endif
    	@endforeach
    	&middot;
    	<span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>
    </div>

    <a href="/message/{{ $message->id }}">
        <p class="group-message">{{ $message->body }}</p>
    </a>
</div>
<hr>
