<?php
$id = $id ?? 'accordion_' . Illuminate\Support\Str::random(6);
?>
<div class="card mb-2" itemscope itemtype="http://schema.org/Question">
  <div class="card-header">
    <h3 class="text-lg mb-0"><a class="block text-black hover:text-gray-700" href="#{{ $id }}" data-toggle="collapse" itemprop="name">{{ $title }}</a></h3>
  </div>
  <div id="{{ $id }}" class="collapse" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div class="card-body antialiased" itemprop="text">{{ $slot }}</div>
  </div>
</div>
