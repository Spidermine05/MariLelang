@if ($paginator->hasPages())
<nav style="display:flex; align-items:center; gap:4px; flex-wrap:wrap; margin-top:16px;">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:5px 11px; font-size:12px; font-weight:600; border-radius:6px; border:1px solid var(--border); background:white; color:#cbd5e1; cursor:not-allowed;">‹ Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:5px 11px; font-size:12px; font-weight:600; border-radius:6px; border:1px solid var(--border); background:white; color:var(--text-muted); text-decoration:none;">‹ Prev</a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:5px 8px; font-size:12px; color:var(--text-muted);">...</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:5px 11px; font-size:12px; font-weight:700; border-radius:6px; border:1px solid var(--brand); background:var(--brand); color:white;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:5px 11px; font-size:12px; font-weight:600; border-radius:6px; border:1px solid var(--border); background:white; color:var(--text-muted); text-decoration:none;">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:5px 11px; font-size:12px; font-weight:600; border-radius:6px; border:1px solid var(--border); background:white; color:var(--text-muted); text-decoration:none;">Next ›</a>
    @else
        <span style="padding:5px 11px; font-size:12px; font-weight:600; border-radius:6px; border:1px solid var(--border); background:white; color:#cbd5e1; cursor:not-allowed;">Next ›</span>
    @endif

</nav>
@endif