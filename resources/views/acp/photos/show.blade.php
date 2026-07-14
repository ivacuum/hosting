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
@if ($model->tags->isNotEmpty())
  <div class="mt-4 flex flex-wrap items-center gap-1.5">
    @foreach ($model->tags as $tag)
      <span class="inline-flex items-stretch overflow-hidden rounded-sm border border-sky-700 text-sm text-sky-700">
        <a class="inline-flex items-center px-2 py-1 lowercase hover:bg-sky-700 hover:text-white" href="{{ Acp::show($tag) }}">
          #{{ $tag->title }}
        </a>
        <form method="POST" action="{{ to('acp/photos/{photo}/tags/{tag}', [$model, $tag]) }}">
          @csrf
          @method('DELETE')
          <button class="h-full cursor-pointer px-2 text-red-600 hover:bg-red-600 hover:text-white" type="submit" aria-label="{{ __('Удалить тэг') }} {{ $tag->title }}" title="@lang('Удалить тэг')">×</button>
        </form>
      </span>
    @endforeach

    <form method="POST" action="{{ to('acp/photos/{photo}/tags', $model) }}" onsubmit="return confirm('@lang('Удалить все тэги?')')">
      @csrf
      @method('DELETE')
      <button class="cursor-pointer rounded-sm border border-red-600 px-2 py-1 text-sm text-red-600 hover:bg-red-600 hover:text-white" type="submit">@lang('Удалить все тэги')</button>
    </form>
  </div>
@endif
@parent
@endsection
