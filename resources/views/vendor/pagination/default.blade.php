<ul class="pagination">
  @if (!$paginator->onFirstPage())
    <li><a class="js-pjax" href="{{ $paginator->previousPageUrl() }}" id="previous_page" rel="prev">&larr;</a></li>
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
    <li><a class="js-pjax" href="{{ $paginator->nextPageUrl() }}" id="next_page" rel="next">&rarr;</a></li>
  @endif
</ul>
