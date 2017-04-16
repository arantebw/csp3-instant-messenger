<div class="list-group">
    <div class="list-group-item">username <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span></div>
    <a class="list-group-item" href="/message/{{ $message->id }}">
        {{ $message->body }}
        <span class="badge badge-default">Counter # of comments</span>
    </a>
</div>
<br>