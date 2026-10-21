<?php /** @var \Illuminate\Pagination\AbstractPaginator $paginator */ ?>
@if($paginator->hasMorePages())
  @php(Head::link('next', $paginator->nextPageUrl(), ['id' => 'next_page']))
@endif
@if(!$paginator->onFirstPage())
  @php(Head::link('prev', $paginator->previousPageUrl(), ['id' => 'prev_page']))
@endif

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
