@php
    $isDetail = request()->routeIs('paste.show');
    $visibilityLabel = match ($paste->visibility) {
        1 => 'Privato',
        2 => 'Non elencato',
        default => 'Pubblico',
    };
    $visibilityClass = match ($paste->visibility) {
        1 => 'status-private',
        2 => 'status-unlisted',
        default => '',
    };
@endphp

<article class="surface-panel paste-card">
    <div class="paste-card__media">
        @if($paste->attachment_path && $paste->hasImageAttachment())
            <img class="paste-card__image" src="{{ route('paste.attachment.show', $paste->id) }}" alt="Anteprima allegato">
        @elseif($paste->attachment_path)
            <div class="file-placeholder">
                <span class="file-placeholder__tag">{{ strtoupper($paste->attachmentExtension() ?: 'FILE') }}</span>
                <p>Allegato pronto alla visualizzazione o al download.</p>
            </div>
        @elseif($paste->file_path)
            <div class="file-placeholder">
                <span class="file-placeholder__tag">TXT</span>
                <p>File testuale pronto al download.</p>
            </div>
        @else
            <div class="file-placeholder file-placeholder--empty">
                <span class="file-placeholder__tag">PASTE</span>
                <p>Contenuto inline senza allegato.</p>
            </div>
        @endif

        <span class="status-chip {{ $visibilityClass }}">{{ $visibilityLabel }}</span>
    </div>

    <div class="paste-card__content">
        <div class="paste-card__header">
            <div>
                <p class="section-kicker">Paste item</p>
                <h2>{{ $paste->title ?: 'Untitled paste' }}</h2>
            </div>

            <div class="paste-meta">
                <span>Autore: {{ $paste->user ? $paste->user->name : 'Guest' }}</span>
                <small>{{ $paste->created_at?->diffForHumans() }}</small>
            </div>
        </div>

        <div class="paste-code-window">
            <div class="window-bar">
                <div class="window-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span>{{ $paste->file_path ? 'export enabled' : 'inline note' }}</span>
            </div>
            <pre>{{ $isDetail ? $paste->content : \Illuminate\Support\Str::limit($paste->content, 620) }}</pre>
        </div>

        @if($paste->tags->count())
            <div class="tag-row">
                @foreach($paste->tags as $tag)
                    <span class="badge-custom">{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif

        <div class="action-cluster">
            @if(!$isDetail)
                <a href="{{ route('paste.show', $paste->url) }}" class="btn btn-sm btn-info">Visualizza</a>
            @endif

            @if($paste->attachment_path)
                <a href="{{ route('paste.attachment.show', $paste->id) }}" target="_blank" class="btn btn-sm btn-primary">Visualizza allegato</a>
                <a href="{{ route('paste.attachment.download', $paste->id) }}" class="btn btn-sm btn-success">Scarica allegato</a>
            @endif

            @if($paste->file_path)
                <a href="{{ route('paste.download', $paste->id) }}" class="btn btn-sm btn-warning">Scarica testo</a>
            @endif

            @if(Auth::check() && Auth::id() === $paste->user_id)
                <a href="{{ route('paste.edit', $paste->id) }}" class="btn btn-sm btn-primary">Modifica</a>
                <form action="{{ route('paste.destroy', $paste->id) }}" method="POST" class="form-inline confirm-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                </form>
            @endif

            @if($paste->visibility == 0 || $paste->visibility == 2)
                <div class="copy-link-group">
                    <input type="text" class="form-control" value="{{ url('/paste/' . $paste->url) }}" readonly>
                    <button type="button" onclick="navigator.clipboard.writeText(this.previousElementSibling.value)" class="btn btn-sm btn-outline-primary">Copia link</button>
                </div>
            @endif
        </div>

        <x-paste-comments :paste="$paste" />
    </div>
</article>
