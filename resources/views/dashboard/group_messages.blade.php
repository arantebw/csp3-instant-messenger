<div>
    <div>
    	{{ $message->member_id }}
    	&middot;
    	<span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>
    </div>

    <a href="/message/{{ $message->id }}">
        {{ $message->body }}
    </a>
</div>
<hr>
