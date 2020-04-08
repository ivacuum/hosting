<nav class="hidden md:flex flex-wrap items-center justify-center">
  @if (!$paginator->onFirstPage())
    <a
      class="px-3 py-1 js-pjax"
      href="{{ $paginator->previousPageUrl() }}"
      id="prev_page"
      rel="prev"
    >
      @svg (chevron-left)
    </a>
  @endif

  @foreach ($elements as $element)
    @if (is_string($element))
      <div class="p-1">{{ $element }}</div>
    @endif

    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <div class="bg-blueish-600 rounded text-white px-3 py-1">{{ $page }}</div>
        @else
          <a class="px-3 py-1 js-pjax" href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <a
      class="px-3 py-1 js-pjax"
      href="{{ $paginator->nextPageUrl() }}"
      id="next_page"
      rel="next"
    >
      @svg (chevron-right)
    </a>
  @endif
</nav>
