<ul class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <li class="disabled"><span>@svg (chevron-left)</span></li>
  @else
    <li><a class="js-pjax tooltipped tooltipped-n" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev" aria-label="{{ trans('pagination.previous') }}">@svg (chevron-left)</a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li><a class="js-pjax tooltipped tooltipped-n" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next" aria-label="{{ trans('pagination.next') }}">@svg (chevron-right)</a></li>
  @else
    <li class="disabled"><span>@svg (chevron-right)</span></li>
  @endif
</ul>
