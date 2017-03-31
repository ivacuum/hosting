@if ($paginator->hasPages())
  <div class="{{ $class ?? 'mt-3 text-center' }}">
    @if ($paginator instanceof Illuminate\Pagination\LengthAwarePaginator)
      {{ $paginator->links('tpl.pagination') }}
    @else
      {{ $paginator->links('tpl.pagination-simple') }}
    @endif
  </div>
@endif
