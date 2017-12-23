<?php
$current = array_keys($values, request($field))[0];
$current = mb_strtolower(mb_substr($current, 0, 1)).mb_substr($current, 1);
?>
<div class="dropdown py-1 mr-3 {{ $class ?? '' }}">
  <span class="text-muted">
    @svg (filter)
  </span>
  <a class="pseudo dropdown-toggle" data-toggle="dropdown">
    {{ $title ?? ViewHelper::modelFieldTrans($model_tpl, $field) }}: {{ $current }}
  </a>
  <ul class="dropdown-menu">
    @foreach ($values as $name => $value)
      <li>
        <a class="js-pjax" href="{{ UrlHelper::filter([$field => $value]) }}">
          {{ $name }}
        </a>
      </li>
    @endforeach
  </ul>
</div>
