<?php
/**
 * @var \App\Domain\Game\Models\Game $game
 */
?>

@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $metaTitle ?? '' }}" property="og:title">
<meta content="{{ canonical() }}" property="og:url">
<meta content="{{ $metaImage ?? '' }}" property="og:image">
<meta content="{{ $metaDescription ?? ViewHelper::metaDescription($routeUri, $metaReplace ?? []) }}" property="og:description">
@endpush

@section('content')
<article>
  <header>
    <h1 class="font-medium text-3xl tracking-tight mb-2">{{ $game->title }}</h1>
    <div class="flex gap-12 mb-6">
      <div class="flex flex-col">
        <dt class="text-sm text-gray-500">@lang('Дата выхода в Steam')</dt>
        <dd>
          <time datetime="{{ $game->released_at->toDateString() }}">
            {{ $game->released_at->isoFormat('LL') }}
          </time>
        </dd>
      </div>
      <div class="flex flex-col">
        <dt class="text-sm text-gray-500">@lang('Дата прохождения')</dt>
        <dd>
          @if($game->finished_at)
            <time datetime="{{ $game->finished_at->toDateString() }}">
              {{ $game->finished_at->isoFormat('LL') }}
            </time>
          @else
            @ru нет @en no @endru
          @endif
        </dd>
      </div>
    </div>
  </header>
  <div class="hanging-punctuation-first lg:text-lg markdown-body break-words border-l-4 border-l-gray-200 pl-4">{{ $game->short_description }}</div>
  <div class="text-right text-gray-500">
    @ru
      — из описания игры в Steam.
    @en
      — from the game description on Steam.
    @endru
  </div>
  <div class="my-4 -mx-4 sm:mx-0">
    <img class="aspect-1920/620" src="{{ $game->libraryHero() }}" alt="" loading="lazy">
  </div>

  @if($reviewTpl)
    <h2 class="font-medium text-3xl tracking-tight mb-2 mt-16">
      @ru
        Мысли и скриншоты
      @en
        Thoughts and screenshots
      @endru
    </h2>
    <div class="hanging-punctuation-first lg:text-lg markdown-body break-words">
      @include($reviewTpl)
    </div>
  @endif
</article>
@endsection
