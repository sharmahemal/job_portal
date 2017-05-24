@if ($paginator->hasPages())
    <div class="ui pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled item"><span>@lang('pagination.previous')</span></a>
        @else
            <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        @else
            <a class="disabled item"><span>@lang('pagination.next')</span></a>
        @endif
    </ul>
@endif
