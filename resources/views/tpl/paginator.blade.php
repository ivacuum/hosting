@if ($paginator->hasPages())
  <div class="{{ $class ?? 'mt-4 text-center' }}">
    @if ($paginator instanceof Illuminate\Pagination\LengthAwarePaginator)
      <div class="md:hidden">
        {{ $paginator->appends(UrlHelper::except())->links('tpl.pagination-simple') }}
      </div>
      {{ $paginator->appends(UrlHelper::except())->links('tpl.pagination') }}
    @else
      {{ $paginator->appends(UrlHelper::except())->links('tpl.pagination-simple') }}
    @endif
  </div>

  @section('pagination_seo')
    @if ($paginator->hasMorePages())
      <link rel="next" href="{{ $paginator->nextPageUrl() }}">
    @endif
    @if (!$paginator->onFirstPage())
      <link rel="prev" href="{{ $paginator->previousPageUrl() }}">
    @endif
  @endsection
@endif
