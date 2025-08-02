@section('pagination_seo')
  @if($paginator->hasMorePages())
    <link rel="next" id="next_page" href="{{ $paginator->nextPageUrl() }}">
  @endif
  @if(!$paginator->onFirstPage())
    <link rel="prev" id="prev_page" href="{{ $paginator->previousPageUrl() }}">
  @endif
@endsection

<nav class="flex flex-wrap">
  @foreach($elements as $element)
    @if(is_string($element))
      <div class="p-1">{{ $element }}</div>
    @endif

    @if(is_array($element))
      @foreach($element as $page => $url)
        @if($page == $paginator->currentPage())
          <div class="bg-sky-700 rounded-sm text-white px-5 py-2">{{ $page }}</div>
        @else
          <a class="px-5 py-2" href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach
</nav>
