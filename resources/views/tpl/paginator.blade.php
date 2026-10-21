<?php /** @var \Illuminate\Pagination\AbstractPaginator $paginator */ ?>
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

  @php(Head::paginate($paginator))
@endif
