@extends('acp.dev.base')

@section('content')
<h2 class="font-medium text-3xl mb-2">SVG</h2>
<div class="text-4xl leading-tight">
  @foreach ($icons as $icon)
    <span class="inline-block mb-1 tooltipped tooltipped-n" aria-label="{{ $icon }}">
      @svg ($icon)
    </span>
  @endforeach
</div>
@endsection
