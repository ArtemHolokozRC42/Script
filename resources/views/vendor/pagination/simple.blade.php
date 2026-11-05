@if ($paginator->hasPages())
    <nav class="pagination">
        @if ($paginator->onFirstPage())
            <span class="disabled">← Назад</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">← Назад</a>
        @endif

        <span class="info">
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
            з {{ $paginator->total() }}
        </span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Далі →</a>
        @else
            <span class="disabled">Далі →</span>
        @endif
    </nav>
@endif
