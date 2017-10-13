@extends('base', [
  'no_language_selector' => true,
])

@section('content')
<article itemscope itemtype="http://schema.org/BlogPosting">
  <header>
    <h1 class="h3 mt-0" itemprop="headline">{{ $news->title }}</h1>
    <link href="{{ $news->www() }}" itemprop="url">
    <div class="text-muted f14 mb-3">
      <span class="text-nowrap mr-3">
        <span class="svg-muted mr-1">
          @svg (calendar-o)
        </span>
        <time itemprop="datePublished" datetime="{{ $news->created_at->toDateString() }}">
          {{ $news->created_at->formatLocalized('%e %B %Y') }}
        </time>
      </span>
      @if ($news->user->login)
        <span class="text-nowrap mr-3">
          <span class="mr-1 svg-muted">
            @svg (pencil)
          </span>
          {{ $news->user->login }}
        </span>
      @endif
      <span class="text-nowrap mr-3">
        <span class="mr-1 svg-muted">
          @svg (eye)
        </span>
        {{ ViewHelper::number($news->views) }}
      </span>
    </div>
  </header>
  <div class="life-text" itemprop="articleBody">{!! $news->html !!}</div>
</article>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['news', $news->id]])
@endsection
