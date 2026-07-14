<?php
/**
 * @var \App\Domain\Life\Models\Photo $model
 */
?>
@extends('acp.show')

@push('head')
@if ($previous)
  <link rel="prev" id="prev_page" href="{{ Acp::show($previous) }}">
@endif
@if ($next)
  <link rel="next" id="next_page" href="{{ Acp::show($next) }}">
@endif
@endpush

@section('content')
<div class="mt-4">
  <div class="aspect-[4/3] w-full max-w-[120vh]">
    <img class="size-full rounded-sm border border-black/10 dark:border-white/10 object-contain" src="{{ $model->originalUrl() }}" alt="">
  </div>
</div>
<div class="mt-4 flex flex-wrap gap-1.5">
  @foreach ($model->tags as $tag)
    <a class="inline-flex items-center px-2 py-0.5 text-sm rounded-sm border border-hover" href="{{ Acp::show($tag) }}">
      #{{ $tag->title }}
    </a>
  @endforeach
</div>
@parent
@endsection
