@extends('acp.dev.base')

@section('content')
<h2 class="mt-0">SVG</h2>
<div class="svg-icon-32">
  @foreach ($icons as $icon)
    <span class="tooltipped tooltipped-n" aria-label="{{ $icon }}"}}>
      @svg ($icon)
    </span>
  @endforeach
</div>
@endsection
