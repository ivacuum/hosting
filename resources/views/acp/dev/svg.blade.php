@extends('acp.dev.base')

@section('content')
<h2 class="m-t-0">SVG</h2>
<div class="svg-icon-32">
  @foreach ($icons as $icon)
    <span title="{{ $icon }}"}}>
    @include("tpl.svg.$icon")
  </span>
  @endforeach
</div>
@endsection
