<?php
/**
 * @var \App\Domain\Life\Models\Photo $model
 */
?>
@extends('acp.show')

@section('content')
<div class="mt-4">
  <img class="image-fit-viewport rounded-sm border border-hover" src="{{ $model->originalUrl() }}" alt="">
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
