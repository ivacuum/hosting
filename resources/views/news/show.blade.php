@extends('base')

@section('content')
<h1 class="h3 mt-0">{{ $news->title }}</h1>
<div class="text-muted f14 mb-3">
  <span class="text-nowrap mr-3">
    <span class="svg-muted mr-1">
      @svg (calendar-o)
    </span>
    {{ $news->created_at->formatLocalized('%e %B %Y') }}
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
<div>{!! $news->html !!}</div>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['news', $news->id]])
@endsection
