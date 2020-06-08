@if ($paginator->hasPages())
    <nav>
        <ul class="flex flex-row">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="text-gray-700 hover:bg-yellow-400 text-center xs:flex-none bg-gray-400 px-4 py-2 m-2">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="text-white text-center bg-yellow-600 hover:bg-yellow-400 px-4 py-2 m-2 active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="text-gray-700 text-center bg-gray-400 px-4 py-2 hover:bg-yellow-400 m-2"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="text-gray-700 text-center bg-gray-400 hover:bg-yellow-400 px-4 py-2 m-2">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
