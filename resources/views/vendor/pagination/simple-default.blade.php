<ul class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <li class="disabled"><span>@svg (chevron-left)</span></li>
  @else
    <li><a class="js-pjax" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev">@svg (chevron-left)</a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li><a class="js-pjax" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next">@svg (chevron-right)</a></li>
  @else
    <li class="disabled"><span>@svg (chevron-right)</span></li>
  @endif
</ul>
