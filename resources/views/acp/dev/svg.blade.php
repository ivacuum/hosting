@extends('acp.dev.base')

@section('content')
<h2>SVG</h2>
<div class="svg-icon-32">
  @foreach ($icons as $icon)
    <span class="tw-inline-block tw-mb-1 tooltipped tooltipped-n" aria-label="{{ $icon }}">
      @svg ($icon)
    </span>
  @endforeach
</div>
@endsection
