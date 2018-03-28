@extends('base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ trans('news.index') }}" href="{{ url(path('NewsRss@index')) }}">
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center font-smooth mb-4">
  <h1 class="h2 mb-1 mr-3">{{ trans('news.index') }}</h1>
  <a class="f18 svg-flex svg-label font-small-caps" href="{{ path('NewsRss@index') }}">
    @svg (rss-square)
    rss
  </a>
</div>
@if (sizeof($news))
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $model)
        <article itemscope itemtype="http://schema.org/BlogPosting">
          <header>
            <h3 itemprop="headline"><a class="link" href="{{ $model->www() }}" itemprop="url">{{ $model->title }}</a></h3>
            <div class="svg-labels svg-muted text-muted f14 mb-3">
              <span class="svg-flex svg-label">
                @svg (calendar-o)
                <time itemprop="datePublished" datetime="{{ $model->created_at->toDateString() }}">
                  {{ $model->created_at->formatLocalized('%e %B %Y') }}
                </time>
              </span>
              @if (optional($model->user)->login)
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
          <div class="{{ !$loop->last ? 'mb-5' : '' }}">
            <div class="d-none d-sm-block life-text js-news-views-observer" itemprop="articleBody" data-id="{{ $model->id }}">{!! $model->html !!}</div>
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
