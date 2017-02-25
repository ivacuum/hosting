<ul class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <li class="disabled"><span>@lang('pagination.previous')</span></li>
  @else
    <li><a class="js-pjax" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev">@lang('pagination.previous')</a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li><a class="js-pjax" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next">@lang('pagination.next')</a></li>
  @else
    <li class="disabled"><span>@lang('pagination.next')</span></li>
  @endif
</ul>
