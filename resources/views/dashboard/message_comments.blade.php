<div>
    <p>username &middot;
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
    </p>

	<a href="/comment/{{ $comment->id }}">{{ $comment->body }}</a>
</div>
<hr>