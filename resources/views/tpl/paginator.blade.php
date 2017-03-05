@if ($paginator->hasPages())
  <div class="{{ $class ?? 'mt-3 text-center' }}">
    {{ $paginator->links() }}
  </div>
@endif
