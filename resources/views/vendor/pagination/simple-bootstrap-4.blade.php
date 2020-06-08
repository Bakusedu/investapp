@if ($paginator->hasPages())
    <nav>
        <ul class="flex justify-between flex-row">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="text-gray-700 text-center rounded bg-gray-400 px-2 py-1 m-2 disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="text-gray-700 hover:bg-yellow-400 rounded text-center xs:flex-none bg-gray-400 px-2 py-1 m-2">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="text-gray-700 hover:bg-yellow-400 rounded text-center xs:flex-none bg-gray-400 px-2 py-1 m-2">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="text-gray-700 text-center rounded bg-gray-400 px-2 py-1 m-2 disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
