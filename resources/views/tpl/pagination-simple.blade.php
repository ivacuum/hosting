<nav class="flex items-center justify-between w-full">
  @if (!$paginator->onFirstPage())
    <a
      class="btn btn-default"
      href="{{ $paginator->previousPageUrl() }}"
      id="prev_page"
      rel="prev"
    >
      {{ trans('pagination.previous') }}
    </a>
  @endif

  <div class="w-2"></div>

  @if ($paginator->hasMorePages())
    <a
      class="btn btn-default"
      href="{{ $paginator->nextPageUrl() }}"
      id="next_page"
      rel="next"
    >
      {{ trans('pagination.next') }}
    </a>
  @endif
</nav>
