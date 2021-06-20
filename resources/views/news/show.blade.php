<?php
/**
 * @var \App\News $news
 */
?>

@extends('base', [
  'noLanguageSelector' => true,
])

@section('content')
<article itemscope itemtype="http://schema.org/BlogPosting">
  <header>
    <h1 class="text-2xl tracking-tight" itemprop="headline">{{ $news->title }}</h1>
    <link href="{{ $news->www() }}" itemprop="url">
    <div class="svg-labels svg-muted text-muted text-sm mb-4">
      <span class="svg-flex svg-label">
        @svg (calendar-o)
        <time itemprop="datePublished" datetime="{{ $news->created_at->toDateString() }}">
          {{ $news->created_at->formatLocalized('%e %B %Y') }}
        </time>
      </span>
      @if ($news->user->login)
        <span class="svg-flex svg-label">
          @svg (pencil)
          {{ $news->user->login }}
        </span>
      @endif
      <span class="svg-flex svg-label">
        @svg (eye)
        {{ ViewHelper::number($news->views) }}
      </span>
    </div>
  </header>
  <div class="antialiased hanging-puntuation-first lg:text-lg markdown-body break-words" itemprop="articleBody">{!! $news->html !!}</div>
</article>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['news', $news->id]])
@endsection
