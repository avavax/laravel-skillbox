@if ($paginator->hasPages())
    <nav class="blog-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="disabled btn btn-outline-secondary" href="#">@lang('pagination.previous')</a>
            @else
                <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    @lang('pagination.previous')
                </a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline-primary" rel="next">
                    @lang('pagination.next')
                </a>
            @else
                <a class="disabled btn btn-outline-secondary" aria-disabled="true" href="#">
                    @lang('pagination.next')
                </a>
            @endif
    </nav>
@endif
