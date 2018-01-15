@php ($id = $id ?? 'accordion_'.str_random(6))
<div class="card mb-2" itemscope itemtype="http://schema.org/Question">
  <div class="card-header">
    <h3 class="f18 mb-0"><a class="d-block text-dark" href="#{{ $id }}" data-toggle="collapse" itemprop="name">{{ $title }}</a></h3>
  </div>
  <div id="{{ $id }}" class="collapse" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div class="card-body font-smooth" itemprop="text">{{ $slot }}</div>
  </div>
</div>
