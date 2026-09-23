<?php /** @var \App\News $model */ ?>

@extends('base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="@lang('Новости')" href="{{ url(to('news/rss')) }}">
@endpush

@section('content')
<div class="flex flex-wrap gap-4 items-center mb-6">
  <h1 class="font-medium text-3xl tracking-tight mb-1">@lang('Новости')</h1>
  <a
    class="text-lg svg-flex svg-label small-caps"
    href="@lng/news/rss"
  >
    @svg (rss-square)
    rss
  </a>
</div>
@if (count($news))
  <div class="md:w-2/3">
    <div>
      @foreach ($news as $model)
        <article itemscope itemtype="https://schema.org/BlogPosting">
          <header>
            <h3 class="font-semibold text-2xl text-balance mb-2" itemprop="headline"><a class="link tracking-tight" href="{{ $model->www() }}" itemprop="url">{{ $model->title }}</a></h3>
            <div class="svg-labels svg-muted text-gray-500 text-sm mb-4">
              <span class="svg-flex svg-label">
                @svg (calendar-o)
                <time itemprop="datePublished" datetime="{{ $model->created_at->toDateString() }}">
                  {{ $model->created_at->isoFormat('LL') }}
                </time>
              </span>
              @if ($model->user?->login)
                <span class="svg-flex svg-label">
                  @svg (pencil)
                  {{ $model->user->login }}
                </span>
              @endif
              <span class="svg-flex svg-label">
                @svg (eye)
                {{ ViewHelper::number($model->views) }}
              </span>
              @if ($model->comments_count)
                <span class="svg-flex svg-label">
                  @svg (comment-o)
                  <span itemprop="commentCount">{{ ViewHelper::number($model->comments_count) }}</span>
                </span>
              @endif
            </div>
          </header>
          <div class="{{ !$loop->last ? 'mb-12' : '' }}">
            <div class="hidden sm:block hanging-punctuation-first lg:text-lg markdown-body break-words js-news-views-observer" itemprop="articleBody" data-id="{{ $model->id }}">{!! $model->html !!}</div>
          </div>
        </article>
      @endforeach
    </div>
  </div>

  @include('tpl.paginator', ['paginator' => $news])
@else
  @ru
    <p>По данным критериям новости не найдены.</p>
  @en
    <p>No news found.</p>
  @endru
@endif

@endsection
