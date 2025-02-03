<?php
/** @var array $values */
/** @var string $field */
$current = array_keys($values, request($field))[0] ?? request($field);
?>
<details class="relative details-reset details-overlay my-1 mr-2 {{ $class ?? '' }}">
  <summary class="btn btn-default">
    <div class="flex items-center">
      <span class="text-muted mr-1">
        @svg (filter)
      </span>
      <span>
        <span class="text-muted">{{ $title ?? ViewHelper::modelFieldTrans($modelTpl, $field) }}:</span>
        <span class="font-medium">{{ $current }}</span>
      </span>
      @svg (angle-down)
    </div>
  </summary>
  <details-menu
    role="menu"
    class="absolute top-full left-0 z-50 py-2 bg-white dark:bg-slate-800 mt-1 border border-gray-300 dark:border-slate-700 rounded shadow-md"
    style="min-width: 10rem;"
  >
    @foreach ($values as $name => $value)
      @if ($name === '---')
        <div class="h-0 my-2 overflow-hidden border-t border-gray-100 dark:border-slate-700"></div>
      @else
        <x-dropdown-item abs-href="{{ UrlHelper::filter([$field => $value]) }}">
          {{ $name }}
        </x-dropdown-item>
      @endif
    @endforeach
  </details-menu>
</details>
