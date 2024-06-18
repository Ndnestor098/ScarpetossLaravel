@if ($paginator->hasPages())
    <div class="pagination" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-semibold text-verde">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-semibold text-verde">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-semibold text-verde">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" class="page-btn page-step" aria-label="{{ __('pagination.previous') }}">
                            &laquo;
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn page-step" rel="prev" aria-label="{{ __('pagination.previous') }}">
                            &laquo;
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-pointer leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="page-btn" data-shown="3">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" id="page-1" class="page-btn" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-btn page-step" aria-label="{{ __('pagination.next') }}">
                            &raquo;
                        </a>
                    @else
                        <span aria-disabled="true" class="page-btn page-step" aria-label="{{ __('pagination.next') }}">
                            &raquo;
                        </span>
                    @endif
                </span>
            </div>
        </div>

    <a href="#page-3" class="page-btn page-step" data-shown="4">&laquo;</a>
    <a href="#page-4" class="page-btn page-step" data-shown="5">&laquo;</a>
    <!-- Previous -->

    <a href="#page-1" id="page-1" class="page-btn">1</a>
    <a href="#page-2" id="page-2" class="page-btn">2</a>
    <a href="#page-3" id="page-3" class="page-btn">3</a>
    <a href="#page-4" id="page-4" class="page-btn">4</a>
    <a href="#page-5" id="page-5" class="page-btn">5</a>
    <!-- Page numbers -->

    <a href="#page-2" class="page-btn page-step" data-shown="1">&raquo;</a>
    <a href="#page-3" class="page-btn page-step" data-shown="2">&raquo;</a>
    <a href="#page-4" class="page-btn page-step" data-shown="3">&raquo;</a>
    <a href="#page-5" class="page-btn page-step" data-shown="4">&raquo;</a>
    <!-- Next -->
</div>