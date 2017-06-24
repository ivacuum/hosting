@if ($paginator->hasPages())
  <div class="{{ $class ?? 'mt-3 text-center' }}">
    @if ($paginator instanceof Illuminate\Pagination\LengthAwarePaginator)
      {{ $paginator->appends(UrlHelper::except())->links('tpl.pagination') }}
    @else
      {{ $paginator->appends(UrlHelper::except())->links('tpl.pagination-simple') }}
    @endif
  </div>
@endif
