@extends('base', [
  'no_language_selector' => true,
])

@section('content')
<article itemscope itemtype="http://schema.org/BlogPosting">
  <header>
    <h1 class="h3" itemprop="headline">{{ $news->title }}</h1>
    <link href="{{ $news->www() }}" itemprop="url">
    <div class="svg-labels svg-muted text-muted f14 mb-3">
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
  <div class="life-text markdown-body text-break-word" itemprop="articleBody">{!! $news->html !!}</div>
</article>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['news', $news->id]])
@endsection
