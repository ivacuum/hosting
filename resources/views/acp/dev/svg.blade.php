@extends('acp.dev.base')

@section('content')
<h3>SVG</h3>
<div class="svg-icon-32">
  @foreach ($icons as $icon)
    <span title="{{ $icon }}"}}>
    @include("tpl.svg.$icon")
  </span>
  @endforeach
</div>
@endsection
