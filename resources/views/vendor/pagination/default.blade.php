@if ($paginator->hasPages())
    <div class="ui pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled item"><span>&laquo;</span></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="item" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="item disabled"><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active item"><span>{{ $page }}</span></a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a><
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="item" rel="next">&raquo;</a>
        @else
            <a class="item disabled"><span>&raquo;</span></a>
        @endif
    </div>
@endif
