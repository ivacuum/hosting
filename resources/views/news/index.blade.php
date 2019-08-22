@extends('base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ trans('news.index') }}" href="{{ url(path('NewsRss@index')) }}">
@endpush

@section('content')
<div class="tw-flex tw-flex-wrap tw-items-center tw-antialiased tw-mb-6">
  <h1 class="h2 tw-mb-1 tw-mr-4">{{ trans('news.index') }}</h1>
  @if (Auth::check())
    <form class="tw-mr-4" action="{{ path('Subscriptions@update') }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      <button class="btn btn-default btn-sm font-small-caps svg-flex svg-label">
        @svg (mail)
        {{ trans(Auth::user()->notify_news ? 'mail.unsubscribe' : 'mail.subscribe') }}
      </button>
      <input type="hidden" name="news" value="{{ Auth::user()->notify_news ? 0 : 1 }}">
      @method('put')
      @csrf
    </form>
  @else
    <a class="btn btn-default btn-sm svg-flex svg-label font-small-caps tw-mr-4" href="{{ path('Subscriptions@edit', ['news' => 1]) }}">
      @svg (mail)
      {{ trans('mail.subscribe') }}
    </a>
  @endif
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
            <div class="svg-labels svg-muted tw-text-gray-600 tw-text-sm tw-mb-4">
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
          <div class="{{ !$loop->last ? 'tw-mb-12' : '' }}">
            <div class="tw-hidden sm:tw-block life-text markdown-body tw-break-words js-news-views-observer" itemprop="articleBody" data-id="{{ $model->id }}">{!! $model->html !!}</div>
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
