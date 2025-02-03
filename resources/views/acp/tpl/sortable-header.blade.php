<a href="{{ UrlHelper::sort($key, $order ?? 'desc') }}">
  @if (isset($svg))
    @svg ($svg)
  @else
    {{ ViewHelper::modelFieldTrans($modelTpl, $key) }}
  @endif
  @if ($sortKey === $key)
    @if ($sortDir === 'desc')
      @svg (angle-down)
    @else
      @svg (angle-up)
    @endif
  @endif
</a>
