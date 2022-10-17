@if ($paginator->hasPages())
<nav>
    <ul class="ts-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a class="item is-back is-disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        </a>
        @else
        <a class="item is-back" href="{{ $paginator->previousPageUrl() }}" rel="prev"
            aria-label="@lang('pagination.previous')"></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <a class="item is-disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <a class="item is-active" aria-current="page">{{ $page }}</a>
        @else
        <a class="item" href="{{ $url }}">{{ $page }}</a>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a class="item is-next" href="{{ $paginator->nextPageUrl() }}" rel="next"
            aria-label="@lang('pagination.next')"></a>
        @else
        <a class="item is-next is-disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        </a>
        @endif
    </ul>
</nav>
@endif