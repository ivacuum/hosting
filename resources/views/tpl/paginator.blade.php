@if ($paginator->hasPages())
  <div class="{{ $class ?? '' }}">
    {{ $paginator->links() }}
  </div>
@endif
