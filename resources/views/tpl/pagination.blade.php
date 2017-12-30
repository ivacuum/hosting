<ul class="pagination pagination-mobile pagination-mobile-only m-0">
  @if ($paginator->onFirstPage())
    <li class="disabled"><span>@svg (chevron-left)</span></li>
  @else
    <li><a class="js-pjax" href="{{ $paginator->previousPageUrl() }}" rel="prev">@svg (chevron-left)</a></li>
  @endif

  @if ($paginator->hasMorePages())
    <li><a class="js-pjax" href="{{ $paginator->nextPageUrl() }}" rel="next">@svg (chevron-right)</a></li>
  @else
    <li class="disabled"><span>@svg (chevron-right)</span></li>
  @endif
</ul>

<ul class="pagination d-none d-sm-inline-block m-0">
  @if (!$paginator->onFirstPage())
    <li><a class="js-pjax tooltipped tooltipped-ne" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev" aria-label="{{ trans('pagination.previous') }}">@svg (chevron-left)</a></li>
  @endif

  @foreach ($elements as $element)
    @if (is_string($element))
      <li class="disabled"><span>{{ $element }}</span></li>
    @endif

    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="active"><span>{{ $page }}</span></li>
        @else
          <li><a class="js-pjax" href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <li><a class="js-pjax tooltipped tooltipped-nw" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next" aria-label="{{ trans('pagination.next') }}">@svg (chevron-right)</a></li>
  @endif
</ul>
