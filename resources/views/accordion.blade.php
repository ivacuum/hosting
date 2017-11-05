@php ($id = $id ?? 'accordion_'.str_random(6))
<div class="panel panel-default mb-2" itemscope itemtype="http://schema.org/Question">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="d-block" href="#{{ $id }}" data-toggle="collapse" itemprop="name">{{ $title }}</a>
    </h4>
  </div>
  <div id="{{ $id }}" class="panel-collapse collapse" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div class="panel-body font-smooth" itemprop="text">{{ $slot }}</div>
  </div>
</div>
