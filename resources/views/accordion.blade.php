@php ($id = $id ?? 'accordion_'.str_random(6))
<div class="panel panel-default mb-2">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a href="#{{ $id }}" data-toggle="collapse">{{ $title }}</a>
    </h4>
  </div>
  <div id="{{ $id }}" class="panel-collapse collapse">
    <div class="panel-body font-smooth">{{ $slot }}</div>
  </div>
</div>
