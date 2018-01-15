<ul class="pagination pagination-mobile m-0">
  @if ($paginator->onFirstPage())
    <li class="page-item disabled"><span class="page-link">@svg (chevron-left)</span></li>
  @else
    <li class="page-item"><a class="page-link js-pjax tooltipped tooltipped-n" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev" aria-label="{{ trans('pagination.previous') }}">@svg (chevron-left)</a></li>
  @endif

  @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link js-pjax tooltipped tooltipped-n" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next" aria-label="{{ trans('pagination.next') }}">@svg (chevron-right)</a></li>
  @else
    <li class="page-link disabled"><span class="page-link">@svg (chevron-right)</span></li>
  @endif
</ul>
