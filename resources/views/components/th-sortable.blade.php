<th class="md:text-left whitespace-nowrap">
  <a href="{{ UrlHelper::sort($key, $defaultOrder ?? 'desc') }}">
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
