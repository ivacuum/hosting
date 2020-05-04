<th class="md:text-left">
  <a href="{{ UrlHelper::sort($key, $order ?? 'desc') }}">
    {{ $slot->isEmpty() ? ViewHelper::modelFieldTrans($modelTpl, $key) : $slot }}
    @if ($sortKey === $key)
      @if ($sortDir === 'desc')
        @svg (angle-down)
      @else
        @svg (angle-up)
      @endif
    @endif
  </a>
</th>
