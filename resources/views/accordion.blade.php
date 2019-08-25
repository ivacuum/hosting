<?php
$id = $id ?? 'accordion_' . Illuminate\Support\Str::random(6);
?>
<div class="card tw-mb-2" itemscope itemtype="http://schema.org/Question">
  <div class="card-header">
    <h3 class="tw-text-lg tw-mb-0"><a class="tw-block tw-text-black hover:tw-text-gray-700" href="#{{ $id }}" data-toggle="collapse" itemprop="name">{{ $title }}</a></h3>
  </div>
  <div id="{{ $id }}" class="collapse" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div class="card-body tw-antialiased" itemprop="text">{{ $slot }}</div>
  </div>
</div>
