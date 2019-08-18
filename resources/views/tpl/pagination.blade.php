<ul class="pagination pagination-mobile d-sm-none tw-m-0">
  @if ($paginator->onFirstPage())
    <li class="page-item disabled"><span class="page-link">@svg (chevron-left)</span></li>
  @else
    <li class="page-item"><a class="page-link js-pjax" href="{{ $paginator->previousPageUrl() }}" rel="prev">@svg (chevron-left)</a></li>
  @endif

  @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link js-pjax" href="{{ $paginator->nextPageUrl() }}" rel="next">@svg (chevron-right)</a></li>
  @else
    <li class="page-item disabled"><span class="page-link">@svg (chevron-right)</span></li>
  @endif
</ul>

<ul class="pagination d-none d-sm-flex tw-m-0 justify-content-center">
  @if (!$paginator->onFirstPage())
    <li class="page-item"><a class="page-link js-pjax tooltipped tooltipped-ne" href="{{ $paginator->previousPageUrl() }}" id="prev_page" rel="prev" aria-label="{{ trans('pagination.previous') }}">@svg (chevron-left)</a></li>
  @endif

  @foreach ($elements as $element)
    @if (is_string($element))
      <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
    @endif

    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
          <li class="page-item"><a class="page-link js-pjax" href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link js-pjax tooltipped tooltipped-nw" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next" aria-label="{{ trans('pagination.next') }}">@svg (chevron-right)</a></li>
  @endif
</ul>
