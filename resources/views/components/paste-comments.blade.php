<div class="card-comments">
    <div class="comments-header">
        <h6>Commenti</h6>
        <span class="comment-count">{{ $paste->comments->count() }} elementi</span>
    </div>

    <div class="comments-stream">
        @forelse($paste->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->authorName() }}:</strong> {{ $comment->content }}
            </div>
        @empty
            <p class="empty-note">Nessun commento per questo paste.</p>
        @endforelse
    </div>

    <form action="{{ route('paste.comment', $paste->id) }}" method="POST" class="comment-form">
        @csrf
        <input type="text" name="content" class="form-control" placeholder="Aggiungi un commento...">
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
</div>
